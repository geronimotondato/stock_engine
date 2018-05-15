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
			
			$this->db->where('nombre', $cliente["nombre"]);
			$this->db->update('cliente', $cliente);

			$this->db->trans_complete();

		}catch (Exception $e){
			throw new Exception("No se pudo guardar el cliente en la base de datos, avise al administrador");
		}

	}

	public function eliminar_cliente($nombre){

		try{

			$this->db->trans_start();
			$this->db->set('dado_de_baja', "1");
			$this->db->where('nombre', $nombre);
			$this->db->update();

			$this->db->trans_complete();

		}catch (Exception $e){
			throw new Exception("No se pudo guardar el cliente en la base de datos, avise al administrador");
		}

	}

}