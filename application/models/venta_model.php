<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Venta_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function guardar_venta($venta) {

		$this->db->trans_start();

		$this->db->query(
			"INSERT INTO venta (id_cuenta,fecha,id_estado)VALUES({$venta['id_cuenta']},\"{$venta['fecha']}\",1)"
		);

		$id_venta = $this->db->insert_id();

		foreach ($venta["items"] as $item) {
			$this->db->query(
				"INSERT INTO item_venta (id_venta, id_producto, cantidad, descuento)VALUES
				({$id_venta}, {$item['id_producto']} , {$item['cantidad']}, {$item['descuento']})"
			);
		}

		$this->load->model("producto_model");

		foreach ($venta["items"] as $item) {
			$this->producto_model->actualizar_stock($item['id_producto'], -$item['cantidad']);
		}

		$lista_productos = $this->producto_model->get_disponibilidad($venta["items"]);

		$productos_sin_stock = array();
		$count = 0;
		foreach ($lista_productos as $producto) {

			if ($producto['disponibles'] < 0) {

				$productos_sin_stock[] = array(
					"id_producto" => $producto['id_producto'],
					"nombre" => $producto['nombre'],
					"cantidad" => abs($producto['disponibles']),
				);
			}
		}

		if (count($productos_sin_stock) > 0) {
			$this->db->trans_rollback();
			return $productos_sin_stock;
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo guardar la venta en la base de datos");
		}

	}

	public function actualizar_venta($venta) {

		$this->db->trans_start();

		//actualizo la fecha de la venta por la recientemente proporcionada
		$this->db->query(
			"UPDATE venta SET fecha = \"{$venta['fecha']}\" WHERE id_venta = {$venta['id_venta']}"
		);

		//vuelvo a agregar los items de la venta al stock de productos
		$this->load->model("producto_model");
		$this->producto_model->recuperar_stock_venta($venta['id_venta']);


		//Elimino los items de la venta
		$this->db->query(
			"DELETE FROM item_venta WHERE id_venta = {$venta['id_venta']}"
		);

		//Agrego los nuevos items
		foreach ($venta["items"] as $item) {
			$this->db->query(
				"INSERT INTO item_venta (id_venta, id_producto, cantidad, descuento)VALUES
				({$venta['id_venta']}, {$item['id_producto']}, {$item['cantidad']}, {$item['descuento']})"
			);
		}

		//actualizo el stock de productos
		foreach ($venta["items"] as $item) {
			$this->producto_model->actualizar_stock($item['id_producto'], -$item['cantidad']);
		}


		//chequeo que haya suficientes productos como para llevar acabo la actualizacion
		$lista_productos = $this->producto_model->get_disponibilidad($venta["items"]);

		$productos_sin_stock = array();
		$count = 0;
		foreach ($lista_productos as $producto) {

			if ($producto['disponibles'] < 0) {

				$productos_sin_stock[] = array(
					"id_producto" => $producto['id_producto'],
					"nombre"      => $producto['nombre'],
					"cantidad"    => abs($producto['disponibles']),
				);

			}
		}

		if (count($productos_sin_stock) > 0) {
			$this->db->trans_rollback();
			return $productos_sin_stock;
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo actualizar la venta en la base de datos");
		}
	}

	public function eliminar_venta($id_venta) {

		$this->db->trans_start();

		//vuelvo a agregar los items de la venta al stock de productos
		$this->load->model('producto_model');
		$this->producto_model->recuperar_stock_venta($id_venta);

		//Elimino la venta
		$this->db->query(
			"DELETE FROM venta WHERE id_venta = {$id_venta}"
		);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo eliminar la venta de la base de datos");
		}

	}

	public function cobrar_venta($id_venta) {

		$this->db->trans_start();

		//Guarda la venta en el historial
		$this->db->query(
			"INSERT INTO historial_venta (id_cuenta, fecha_alta, fecha_venta)
			SELECT id_cuenta, fecha_alta, fecha_venta
			FROM   venta o
			WHERE  o.id_venta =" . $id_venta);

		//tomo el id del registro historial recientemente creado
		$last_insert = $this->db->insert_id();

		//guardo todos los items de la venta en el historial de items
		$this->db->query(
			"INSERT INTO historial_item (id_venta, nombre, unidades, costo, precio_venta, cantidad, descuento)
			SELECT " . $last_insert . " AS id_venta, p.nombre, p.unidades, p.costo, p.precio_venta, i.cantidad, i.descuento FROM item i JOIN producto p ON i.id_producto = p.id_producto WHERE i.id_venta =" . $id_venta);

		//actualizo el stock de los productos restando las cantidades vendidas
		$this->db->query(
			"UPDATE producto dest,
					(SELECT i.id_producto, sum(i.cantidad) AS suma FROM item i WHERE i.id_venta =" . $id_venta . " GROUP BY i.id_producto) src

					SET dest.stock = dest.stock - src.suma
					WHERE dest.id_producto = src.id_producto");

		//borro el registro de la tabla venta
		$this->db->query(
			"DELETE FROM venta WHERE venta.id_venta =" . $id_venta);

		//borro los items asociados a esa venta de la tabla item
		$this->db->query(
			"DELETE FROM item WHERE item.id_venta =" . $id_venta);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo cobrar la venta en la base de datos");
		}
	}

	public function get_venta($id_venta) {

		try {

			$venta = null;

			$query = $this->db->query("SELECT * FROM venta WHERE id_venta = {$id_venta}");
			$row = $query->row();

			if (isset($row)) {

				//recupero la info relacionada al cliente
				$cliente = $this->db->query("
				SELECT * FROM cliente cl LEFT JOIN cuenta cu             
				ON cl.id_cuenta = cu.id_cuenta
				WHERE cl.id_cuenta = {$row->id_cuenta}");

				//recupero la info relacionada a los items
				$items = $this->db->query(
					"SELECT id_item, i.id_producto, nombre, cantidad, descuento
					FROM item_venta i LEFT JOIN producto p
					ON i.id_producto = p.id_producto
					WHERE i.id_venta = {$id_venta}");

				//genero el array con toda la info de la venta
				$venta["id_venta"] = $row->id_venta;
				$venta["fecha"] = $row->fecha;
				$venta["cliente"] = $cliente->row_array();
				$venta["items"] = $items->result_array();
			}

			return $venta;

		} catch (Exception $e) {
			throw new Exception("No se pudo recuperar la venta de la base de datos");
		}

	}

	public function get_lista_ventas($estado) {

		// $limit = $elementos_por_pagina;
		// $offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		try {

			$query = $this->db->query(
				"SELECT * FROM venta v LEFT JOIN cliente c ON v.id_cuenta = c.id_cuenta
				LEFT JOIN cuenta cu ON c.id_cuenta = cu.id_cuenta
				WHERE v.id_estado = {$estado}
				ORDER BY v.fecha DESC, v.ultima_modificacion DESC LIMIT 10"
			);

			$query = $query->result_array();

			foreach ($query as $row) {

				$ventas[] = $row;
			}

			if (isset($ventas)) {

				foreach ($ventas as $key => $venta) {

					$query = $this->db->query(
						"SELECT iv.id_item, iv.id_producto, p.nombre, iv.cantidad, iv.descuento,
						p.precio_venta, iv.cantidad*p.precio_venta*(1 - iv.descuento/100) as total
						FROM item_venta iv LEFT JOIN producto p on iv.id_producto = p.id_producto
						WHERE id_venta={$venta['id_venta']}"
					);

					$ventas[$key]["items"] = $query->result_array();
					$ventas[$key]["total_venta"] = 0;
					foreach ($ventas[$key]["items"] as $item) {
						$ventas[$key]["total_venta"] += $item["total"];
					}
				}
			} else {
				$ventas = false;
			}

			return $ventas;

		} catch (Exception $e) {
			throw new Exception("No se pudo recuperar la venta de la base de datos");
		}

	}

	// public function cantidad_ventas() {
	// 	$query = $this->db->query("SELECT count(1) as total FROM venta WHERE id_estado=1");
	// 	return $query->row_array()["total"];
	// }

	// public function cantidad_paginas($ventas_por_pagina) {
	// 	return ceil($this->cantidad_ventas() / $ventas_por_pagina);
	// }

}