<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function guardar_orden($orden){

		try{

			$this->db->trans_start();

			$this->db->query(
				"INSERT INTO orden (id_cliente, fecha_entrega)VALUES(".$orden['cliente'].",\"".$orden['fecha']."\")"
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

			$this->db->trans_complete();
		}catch (Exception $e){
			throw new Exception("No se pudo guardar la orden en la base de datos, avise al administrador");
		}

	}


	public function actualizar_orden($orden){

		try{

			$this->db->trans_start();

			$this->db->query(
				"UPDATE orden SET id_cliente = ".$orden['cliente'].", fecha_entrega =\"".$orden['fecha']."\" WHERE
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

			$this->db->trans_complete();
		}catch (Exception $e){
			throw new Exception("No se pudo guardar la orden en la base de datos, avise al administrador");
		}

	}

	public function get_orden($id_orden){

		try{

			$orden = array(
				"cliente" => "",
				"fecha"   => "",
				"items"   => []
			);


			$query = $this->db->query("SELECT * FROM orden WHERE id_orden = ". $id_orden);
			$row = $query->row();

			$orden["id_orden"] = $row->id_orden;
			$orden["cliente"]  = $row->id_cliente;
			$orden["fecha"]    = $row->fecha_entrega;

			$query = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento FROM item left join producto on item.id_producto = producto.id_producto WHERE id_orden = ". $id_orden);

			$orden["items"] = $query->result_array();

			return $orden;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la orden de la base de datos");
		}

	}




	public function get_orden_list($desde, $hasta){

		try{

			$query = $this->db->query("SELECT * FROM orden LEFT JOIN cliente on orden.id_cliente = cliente.id_cliente  ORDER BY fecha_entrega ASC LIMIT ". $desde.",".$hasta );

			$query = $query->result_array();

			foreach ($query as $row){

				$ordenes[] = $row;
			}


			foreach ($ordenes as $key => $orden){

				$query = $this->db->query( "SELECT id_item, item.id_producto, nombre, cantidad, descuento FROM item LEFT JOIN producto on item.id_producto = producto.id_producto WHERE id_orden = ". $orden["id_orden"]);

				$ordenes[$key]["items"] = $query->result_array();

			}

			return $ordenes;

		}catch (Exception $e){
			throw new Exception("No se pudo recuperar la orden de la base de datos");
		}

	}


}