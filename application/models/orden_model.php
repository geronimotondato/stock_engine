<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// ******************************************************************************
	// ► Func : consulta a la base de datos en busca de la lista de productos
	// ► Obser: devuelve toda la lista de productos
	// ► ToDo :
	// ******************************************************************************
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

	public function get_orden($id_orden){

		try{

			$orden = array(
				"cliente" => "",
				"fecha"   => "",
				"items"   => []
			);


			$query = $this->db->query("SELECT id_cliente, fecha_entrega FROM orden WHERE id_orden = ". $id_orden);
			$row = $query->row();

			$orden["cliente"] = $row->id_cliente;
			$orden["fecha"] = $row->fecha_entrega;

			$query = $this->db->query( "SELECT * FROM item WHERE id_orden = ". $id_orden);

			$orden["items"] = $query->result_array();

			return $orden;

		}catch (Exception $e){
			throw new Exception("No se pudo guardar recuperar la orden de la base de datos");
		}

	}

}