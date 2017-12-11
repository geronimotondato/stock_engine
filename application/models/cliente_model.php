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
	public function get_lista_clientes()
	{
		$query = $this->db->query("select * from cliente;");
		if(empty($query)){
			throw new Exception("No hay clientes");
		}
		return $query->result();  
	}
}