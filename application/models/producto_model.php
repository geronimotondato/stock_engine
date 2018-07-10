<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Producto_model extends CI_Model {

	var $tabla;
	var $id_column;

	public function __construct(){

		$this->tabla = "producto";
		$this->id_column = "id_producto";

		parent::__construct(); 
	}
	
	public function guardar_elemento($elemento){

		$this->db->trans_start();
		
		$this->db->insert($this->tabla, $elemento);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		   throw new Exception("No se pudo guardar {$this->tabla} en la base de datos");
		}
	}

	public function actualizar_elemento($elemento){

		$this->db->trans_start();

		$this->db->where($this->id_column, $elemento[$this->id_column]);
		$this->db->update($this->tabla, $elemento);

		$this->db->trans_complete();


		//chequeo si la transaccion falló en cuyo caso lanzo una excepcion
		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo actualizar {$this->tabla} en la base de datos");
		}
	}

	public function eliminar_elemento($id_elemento){

		$this->db->trans_start();

		//pongo en null el id_elemento de los productos que pertenecen a la elemento que va a ser elimina
		$this->db->set($this->id_column, NULL);
		$this->db->where($this->id_column, $id_elemento);
		$this->db->update('producto');

		//Elimino el elemento
		$this->db->where($this->id_column, $id_elemento);
		$this->db->delete($this->tabla);


		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		throw new Exception("No se pudo eliminar {$this->tabla} de la base de datos");
		}
	}

	public function get_elemento($id_elemento){

		$query=$this->db->query("SELECT * FROM {$this->tabla} WHERE {$this->id_column}={$id_elemento}");

		try{

			if(empty($query->row())) throw new Exception("No existe {$this->tabla}");
			return $query->row();

		}catch (Throwable $t){
			throw new Exception($t->getMessage());
		}catch (Exception $e){
			throw new Exception($e->getMessage());
		}
	}

	public function get_lista_elementos_completa(){


		$query = $this->db->query("select * from {$this->tabla}");
		if(empty($query)){ throw new Exception("No hay registros de {$this->tabla}");}
		return $query->result();  
	}

	public function buscar_elemento($texto_busqueda){

		$query = $this->db->query(
			"SELECT * FROM {$this->tabla} WHERE
			 MATCH(nombre) 
			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)" );

			if(empty($query)){ throw new Exception("No se encuentra {$this->tabla}");}

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