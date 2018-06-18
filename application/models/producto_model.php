<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Producto_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_lista_productos() {
		$query = $this->db->query("SELECT * FROM producto");
		if (empty($query)) {
			throw new Exception("No hay productos en la tabla productos");
		}
		return $query->result();
	}

	public function get_disponibilidad($items) {

		$ids_producto = array();

		foreach ($items as $item) {
			if (!in_array($item["id_producto"], $ids_producto)) {
				$ids_producto[] = $item["id_producto"];
			}
		}

		$commaList = implode(',', $ids_producto);

		$query = $this->db->query("SELECT p.id_producto, p.nombre, p.stock as disponibles
		FROM producto p
		WHERE p.id_producto in ({$commaList})");

		return $query->result_array();
	}

	public function actualizar_stock($id_producto, $cantidad){

		$this->db->query("UPDATE producto SET stock = stock + {$cantidad} WHERE id_producto = {$id_producto}");

	}

	public function recuperar_stock_venta($id_venta){

			$this->db->query(
			"UPDATE producto dest,
				(SELECT i.id_producto, sum(i.cantidad) AS suma 
				FROM item_venta i 
				WHERE i.id_venta ={$id_venta} 
				GROUP BY i.id_producto) src

				SET dest.stock = dest.stock + src.suma
				WHERE dest.id_producto = src.id_producto"
		);

	}
}


	// ******************************************************************************************
	// ► Func : recibe un array de items y devuelve una tabla con la forma [id_producto, disponibilidad]
	// ► Obser:
	// ► ToDo :
	// ******************************************************************************************
	// public function get_disponibilidad($items) {

	// 	$ids_producto = array();

	// 	foreach ($items as $item) {
	// 		if (!in_array($item["id_producto"], $ids_producto)) {
	// 			$ids_producto[] = $item["id_producto"];
	// 		}
	// 	}

	// 	$commaList = implode(',', $ids_producto);

	// 	$query = $this->db->query("SELECT p.id_producto, p.nombre, p.stock - COALESCE(SUM(i.cantidad),0) as disponibles
	// 	FROM producto p LEFT JOIN item i ON p.id_producto = i.id_producto
	// 	WHERE p.id_producto in (" . $commaList . ")
	// 	GROUP BY p.id_producto;");

	// 	return $query->result_array();
	// }