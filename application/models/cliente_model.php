<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// ******************************************************************************
	// ► Func : consulta a la base de datos en busca de la lista de productos
	// ► Obser: devuelve toda la lista de productos
	// ► ToDo :
	// ******************************************************************************
	public function get_lista_clientes(){
		$query = $this->db->query("select * from cliente where dado_de_baja=0");
		if(empty($query)){
			throw new Exception("No hay clientes");
		}
		return $query->result();  
	}



	public function get_cliente($id_cliente){

		$query = $this->db->query("SELECT * FROM cliente WHERE id_cliente = " . $id_cliente);

		if(empty($query->row())){
			throw new Exception("El cliente no existe");
		}

		return $query->row();
	}


	public function guardar_cliente($cliente){

		try{

			$this->db->trans_start();
			
			$this->db->insert('cliente', $cliente);

			$this->db->trans_complete();

		}catch (Exception $e){
			throw new Exception("No se pudo guardar el cliente en la base de datos, avise al administrador");
		}

	}

	public function actualizar_cliente($cliente){

		try{

			$this->db->trans_start();

			$this->db->select('dado_de_baja');
			$query = $this->db->get_where('cliente', array('id_cliente' => $cliente["id_cliente"]) );

			if ($query->row()->dado_de_baja == FALSE){

				$this->db->where('id_cliente', $cliente["id_cliente"]);
				$this->db->update('cliente', $cliente);

				$this->db->trans_complete();

			}else{

				$this->db->trans_complete();
				throw new Exception("No puede actualizar un cliente dado de baja", 1);
			}

		}catch (Exception $e){

			if($e->getCode() == 1){
				throw $e;
			}else{
				throw new Exception("No se pudo actualizar el cliente en la base de datos, avise al administrador");
			}
			
		}

	}

	public function eliminar_cliente($nombre){

		try{

			$this->db->trans_start();
			$this->db->set('dado_de_baja', TRUE);
			$this->db->where('nombre', $nombre);
			$this->db->update('cliente');

			$this->db->trans_complete();

		}catch (Exception $e){
			throw new Exception("No se pudo eliminar el cliente en la base de datos, avise al administrador");
		}

	}

}