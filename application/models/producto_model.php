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
		$query = $this->db->query("SELECT * from vista_stock;");
		if(empty($query)){
			throw new Exception("No hay productos en la tabla productos");
		}
		return $query->result_object();  
	}


	// ******************************************************************************************
	// ► Func : recibe un array de items y devuelve una tabla con la forma [id_producto, disponibilidad]
	// ► Obser: 
	// ► ToDo :
	// ******************************************************************************************
	public function get_disponibilidad($items){

		$ids_producto = array();

		foreach ($items as $item){
			if (!in_array($item["id_producto"], $ids_producto)){
				$ids_producto[] = $item["id_producto"];
			}
		}

		$commaList = implode(',', $ids_producto);

		$query = $this->db->query("SELECT p.id_producto, p.nombre, p.stock - COALESCE(SUM(i.cantidad),0) as disponibles 
		FROM producto p LEFT JOIN item i ON p.id_producto = i.id_producto 
		WHERE p.id_producto in (" . $commaList . ") 
		GROUP BY p.id_producto;");

		return array_column($query->result_object(), "disponibles" , "id_producto");

	}

	function array_column_multi(array $input, array $column_keys) {
	    $result = array();
	    $column_keys = array_flip($column_keys);
	    foreach($input as $key => $el) {
	        $result[$key] = array_intersect_key($el, $column_keys);
	    }
	    return $result;
	}

}