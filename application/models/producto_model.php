<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// ******************************************************************************
	// ► Func : consulta a la base de datos en busca de la lista de productos
	// ► Obser: devuelve toda la lista de productos
	// ► ToDo :
	// ******************************************************************************
	public function get_lista_productos()
	{
		$query = $this->db->query("select * from producto;");
		if(empty($query)){
			throw new Exception("No hay productos en la tabla productos");
		}
		return $query->result();  
	}

	// ******************************************************************************************
	// ► Func : consulta a la base de datos en busca de la lista de productos y calcula el stock
	// ► Obser: devuelve toda la lista de productos y su stock
	// ► ToDo :
	// ******************************************************************************************
	public function get_stock_productos()
	{
		$query = $this->db->query("select * from vista_stock;");
		if(empty($query)){
			throw new Exception("No hay productos en la tabla productos");
		}
		return $query->result();  
	}

}