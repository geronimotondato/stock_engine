<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class venta_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function guardar_venta($venta){

		$this->db->trans_start();

		$this->db->query(
			"INSERT INTO venta (id_cliente, fecha_venta)VALUES(".$venta['id_cliente'].",\"".$venta['fecha']."\")"
		);

		$id_venta = $this->db->insert_id();

		foreach ($venta["items"] as $item){
			$this->db->query(
				"INSERT INTO item (id_venta, id_producto, cantidad, descuento)VALUES
				(".$id_venta.",
				".$item['id_producto'].",
				".$item['cantidad'].",
				".$item['descuento']."
				)"
			);
		}

		$this->load->model("producto_model");
		$lista_productos = $this->producto_model->get_disponibilidad($venta["items"]);

		$productos_sin_stock = array();
		$count = 0;
		foreach($lista_productos as $producto){

			if($producto['disponibles'] < 0){
		
				$productos_sin_stock[] = array(
					"id_producto" => $producto['id_producto'],
					"nombre"      => $producto['nombre'],
					"cantidad"    => abs($producto['disponibles'])
				);
			}
		}

		if (count($productos_sin_stock) > 0){
			$this->db->trans_rollback();
			return $productos_sin_stock;
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo guardar la venta en la base de datos");
		}

	}


	public function actualizar_venta($venta){

		$this->db->trans_start();

		$this->db->query(
			"UPDATE venta SET fecha_venta = \"" .$venta['fecha'] ."\" WHERE
			id_venta =" . $venta['id_venta']
		);
		$this->db->query(
			"DELETE FROM item WHERE id_venta =". $venta['id_venta']
		);
		foreach ($venta["items"] as $item){
			$this->db->query(
				"INSERT INTO item (id_venta, id_producto, cantidad, descuento)VALUES
				(
					".$venta['id_venta'].",
					".$item['id_producto'].",
					".$item['cantidad'].",
					".$item['descuento']."
				)"
			);
		}

		$this->load->model("producto_model");
		$lista_productos = $this->producto_model->get_disponibilidad($venta["items"]);

		$productos_sin_stock = array();
		$count = 0;
		foreach($lista_productos as $producto){

			if($producto['disponibles'] < 0){
		
				$productos_sin_stock[] = array(

					"id_producto" => $producto['id_producto'],
					"nombre"      => $producto['nombre'],
					"cantidad"   => abs($producto['disponibles'])
				);

			}
		}

		if (count($productos_sin_stock) > 0){
			$this->db->trans_rollback();
			return $productos_sin_stock;
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo actualizar la venta en la base de datos");
		}
	}


	public function eliminar_venta($id_venta){

		$this->db->trans_start();

		$this->db->query(
			"DELETE FROM venta WHERE id_venta =". $id_venta
		);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo eliminar la venta de la base de datos");
		}

	}

	public function finalizar_venta($id_venta){

		$this->db->trans_start();
			
			//Guarda la venta en el historial
			$this->db->query(
			"INSERT INTO historial_venta (id_cliente, fecha_alta, fecha_venta)
			SELECT id_cliente, fecha_alta, fecha_venta
			FROM   venta o
			WHERE  o.id_venta =". $id_venta);

			//tomo el id del registro historial recientemente creado
			$last_insert = $this->db->insert_id();

			//guardo todos los items de la venta en el historial de items
			$this->db->query(
			"INSERT INTO historial_item (id_venta, nombre, unidades, costo, precio_venta, cantidad, descuento)
			SELECT ". $last_insert ." AS id_venta, p.nombre, p.unidades, p.costo, p.precio_venta, i.cantidad, i.descuento FROM item i JOIN producto p ON i.id_producto = p.id_producto WHERE i.id_venta =". $id_venta);

			//actualizo el stock de los productos restando las cantidades vendidas
			$this->db->query(
			"UPDATE producto dest,
					(SELECT i.id_producto, sum(i.cantidad) AS suma FROM item i WHERE i.id_venta =". $id_venta ." GROUP BY i.id_producto) src
			       
					SET dest.stock = dest.stock - src.suma
					WHERE dest.id_producto = src.id_producto");

			//borro el registro de la tabla venta
			$this->db->query(
			"DELETE FROM venta WHERE venta.id_venta =". $id_venta);

			//borro los items asociados a esa venta de la tabla item
			$this->db->query(
			"DELETE FROM item WHERE item.id_venta =". $id_venta);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo finalizar la venta en la base de datos");
		}
	}


	public function get_venta($id_venta){

		try{

			$venta = null;

			$query = $this->db->query("SELECT * FROM venta WHERE id_venta = ". $id_venta);
			$row = $query->row();
			
			if (isset($row)){

				//recupero la info relacionada al cliente
				$cliente = $this->db->query( "SELECT * FROM cliente WHERE id_cliente = ". $row->id_cliente);

				//recupero la info relacionada a los items
				$items = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento FROM item left join producto on item.id_producto = producto.id_producto WHERE id_venta = ". $id_venta);

				//genero el array con toda la info de la venta
				$venta["id_venta"] = $row->id_venta;
				$venta["fecha"]    = $row->fecha_venta;
				$venta["cliente"]  =$cliente->row_array();
				$venta["items"]    = $items->result_array();
			}
			
			return $venta;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la venta de la base de datos");
		}

	}

	public function get_lista_ventas_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		try{

			$query = $this->db->query("SELECT * FROM venta LEFT JOIN cliente on venta.id_cliente = cliente.id_cliente ORDER BY fecha_venta ASC LIMIT ". $limit." offset " . $offset);

			$query = $query->result_array();

			foreach ($query as $row){

				$ventas[] = $row;
			}

			if (isset($ventas)){

				foreach ($ventas as $key => $venta){

					$query = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento, precio_venta, cantidad*precio_venta*(1 - descuento/100) as total FROM item LEFT JOIN producto on item.id_producto = producto.id_producto WHERE id_venta = ". $venta["id_venta"]);

					$ventas[$key]["items"] = $query->result_array();
					$ventas[$key]["total_venta"] = 0;
					foreach($ventas[$key]["items"] as $item){
						$ventas[$key]["total_venta"] += $item["total"];
					}
				}
			}else{
				$ventas = false;
			}

			return $ventas;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la venta de la base de datos");
		}

	}

	public function cantidad_ventas(){
		$query = $this->db->query("select count(*) from venta");
		return $query->row_array()["count(*)"];
	}

	public function cantidad_paginas($ventas_por_pagina){
		return ceil($this->cantidad_ventas() / $ventas_por_pagina);		
	}

}