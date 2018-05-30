<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function guardar_orden($orden){

		$this->db->trans_start();

		$this->db->query(
			"INSERT INTO orden (id_cliente, fecha_entrega)VALUES(".$orden['id_cliente'].",\"".$orden['fecha']."\")"
		);

		$id_orden = $this->db->insert_id();

		foreach ($orden["items"] as $item){
			$this->db->query(
				"INSERT INTO item (id_orden, id_producto, cantidad, descuento)VALUES
				(".$id_orden.",
				".$item['id_producto'].",
				".$item['cantidad'].",
				".$item['descuento']."
				)"
			);
		}

		$this->load->model("producto_model");
		$lista_productos = $this->producto_model->get_disponibilidad($orden["items"]);

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
			throw new Exception("No se pudo guardar la orden en la base de datos");
		}

	}


	public function actualizar_orden($orden){

		$this->db->trans_start();

		$this->db->query(
			"UPDATE orden SET fecha_entrega = \"" .$orden['fecha'] ."\" WHERE
			id_orden =" . $orden['id_orden']
		);
		$this->db->query(
			"DELETE FROM item WHERE id_orden =". $orden['id_orden']
		);
		foreach ($orden["items"] as $item){
			$this->db->query(
				"INSERT INTO item (id_orden, id_producto, cantidad, descuento)VALUES
				(
					".$orden['id_orden'].",
					".$item['id_producto'].",
					".$item['cantidad'].",
					".$item['descuento']."
				)"
			);
		}

		$this->load->model("producto_model");
		$lista_productos = $this->producto_model->get_disponibilidad($orden["items"]);

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
			throw new Exception("No se pudo actualizar la orden en la base de datos");
		}
	}


	public function eliminar_orden($id_orden){

		$this->db->trans_start();

		$this->db->query(
			"DELETE FROM orden WHERE id_orden =". $id_orden
		);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo eliminar la orden de la base de datos");
		}

	}

	public function finalizar_orden($id_orden){

		$this->db->trans_start();
	
			$this->db->query(
			"INSERT INTO historial_orden (id_cliente, fecha_orden, fecha_entrega)
			SELECT id_cliente, fecha_orden, fecha_entrega
			FROM   orden o
			WHERE  o.id_orden =". $id_orden);

			$last_insert = $this->db->insert_id();

			$this->db->query(
			"INSERT INTO historial_item (id_orden, nombre, unidades, precio_compra, precio_venta, cantidad, descuento)
			SELECT ". $last_insert ." AS id_orden, p.nombre, p.unidades, p.precio_compra, p.precio_venta, i.cantidad, i.descuento FROM item i JOIN producto p ON i.id_producto = p.id_producto WHERE i.id_orden =". $id_orden);

			$this->db->query(
			"UPDATE producto dest,
					(SELECT i.id_producto, sum(i.cantidad) AS suma FROM item i WHERE i.id_orden =". $id_orden ." GROUP BY i.id_producto) src
			       
					SET dest.stock = dest.stock - src.suma
					WHERE dest.id_producto = src.id_producto");

			$this->db->query(
			"DELETE FROM orden WHERE orden.id_orden =". $id_orden);

			$this->db->query(
			"DELETE FROM item WHERE item.id_orden =". $id_orden);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo finalizar la orden en la base de datos");
		}
	}


	public function get_orden($id_orden){

		try{

			$orden = null;

			$query = $this->db->query("SELECT * FROM orden WHERE id_orden = ". $id_orden);
			$row = $query->row();
			
			if (isset($row)){

				//recupero la info relacionada al cliente
				$cliente = $this->db->query( "SELECT * FROM cliente WHERE id_cliente = ". $row->id_cliente);

				//recupero la info relacionada a los items
				$items = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento FROM item left join producto on item.id_producto = producto.id_producto WHERE id_orden = ". $id_orden);

				//genero el array con toda la info de la orden
				$orden["id_orden"] = $row->id_orden;
				$orden["fecha"]    = $row->fecha_entrega;
				$orden["cliente"]  =$cliente->row_array();
				$orden["items"]    = $items->result_array();
			}
			
			return $orden;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la orden de la base de datos");
		}

	}

	public function get_lista_ordenes_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		try{

			$query = $this->db->query("SELECT * FROM orden LEFT JOIN cliente on orden.id_cliente = cliente.id_cliente ORDER BY fecha_entrega ASC LIMIT ". $limit." offset " . $offset);

			$query = $query->result_array();

			foreach ($query as $row){

				$ordenes[] = $row;
			}

			if (isset($ordenes)){

				foreach ($ordenes as $key => $orden){

					$query = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento, precio_venta, cantidad*precio_venta*(1 - descuento/100) as total FROM item LEFT JOIN producto on item.id_producto = producto.id_producto WHERE id_orden = ". $orden["id_orden"]);

					$ordenes[$key]["items"] = $query->result_array();
					$ordenes[$key]["total_orden"] = 0;
					foreach($ordenes[$key]["items"] as $item){
						$ordenes[$key]["total_orden"] += $item["total"];
					}
				}
			}else{
				$ordenes = false;
			}

			return $ordenes;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la orden de la base de datos");
		}

	}

	public function cantidad_ordenes(){
		$query = $this->db->query("select count(*) from orden");
		return $query->row_array()["count(*)"];
	}

	public function cantidad_paginas($ordenes_por_pagina){
		return ceil($this->cantidad_ordenes() / $ordenes_por_pagina);		
	}

}