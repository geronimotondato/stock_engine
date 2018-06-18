<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Cliente_model extends CI_Model {

	var $tabla1;
	var $tabla2;
	var $id_column;

	public function __construct() {

		$this->tabla1 = "cliente";
		$this->tabla2 = "cuenta";
		$this->id_column = "id_cuenta";

		parent::__construct();
	}

	public function guardar_elemento($elemento) {

		$this->db->trans_start();

		$this->db->insert($this->tabla1, $elemento);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo guardar {$this->tabla1} en la base de datos");
		}
	}

	public function actualizar_elemento($elemento) {

		$this->db->trans_start();

		//trae el campo "dado_de_baja" y "saldo" del cliente que se pretende actualizar
		$this->db->SELECT('dado_de_baja, saldo');
		$query = $this->db->get_where($this->tabla1, array($this->id_column => $elemento[$this->id_column]));

		//pregunto si el cliente está dado de baja, en cuyo caso finalizo la actualizacion
		if ($query->row()->dado_de_baja == TRUE) {
			$this->db->trans_complete();
			throw new Exception("No puede actualizar un {$this->tabla1} dado de baja");
		}

		//actualizo el saldo del cliente sumando el valor "saldo" de la BD
		//con el valor "saldo" que viene por el pedido
		//que es el resultado de $sumar - $restar
		$elemento["saldo"] = $elemento["saldo"] + $query->row()->saldo;

		//actualizo el cliente
		$this->db->where($this->id_column, $elemento[$this->id_column]);
		$this->db->update($this->tabla1, $elemento);

		$this->db->trans_complete();

		//chequeo si la transaccion falló en cuyo caso lanzo una excepcion
		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo actualizar {$this->tabla1} en la base de datos");
		}
	}

	public function eliminar_elemento($id_elemento) {

		$this->db->trans_start();

		$this->db->set('dado_de_baja', TRUE);
		$this->db->where($this->id_column, $id_elemento);
		$this->db->update($this->tabla1);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			throw new Exception("No se pudo eliminar {$this->tabla1} de la base de datos");
		}
	}

	public function get_elemento($id_elemento) {

		$query = $this->db->query("SELECT * FROM {$this->tabla1} t1 LEFT JOIN {$this->tabla2} t2 ON
		t1.{$this->id_column} = t2.{$this->id_column} WHERE t2.{$this->id_column} = {$id_elemento}");

		if (empty($query->row())) {throw new Exception("No existe {$this->tabla1}");}

		return $query->row();
	}

	public function get_lista_elementos_completa() {

		$query = $this->db->query("SELECT * FROM {$this->tabla1} LEFT JOIN {$this->tabla2} ON
		{$this->tabla1}.{$this->id_column} = {$this->tabla2}.{$this->id_column}
		WHERE dado_de_baja=0");
		if (empty($query)) {throw new Exception("No hay registros de {$this->tabla1}");}
		return $query->result();
	}

	public function get_lista_elementos_pagina($numero_pagina, $elementos_por_pagina) {

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		$query = $this->db->query("SELECT * FROM {$this->tabla1} t1 JOIN {$this->tabla2} t2
		 ON t1.id_cuenta = t2.id_cuenta
		 WHERE t2.dado_de_baja=0 LIMIT {$limit} OFFSET {$offset}");

		if (empty($query)) {throw new Exception("No hay registros de {$this->tabla1}");}

		return $query->result();

		return $return;

	}

	public function buscar_elemento($texto_busqueda) {

		$query = $this->db->query(
			"SELECT * FROM {$this->tabla1}
			 WHERE dado_de_baja=0 AND
			 MATCH(nombre, direccion, email, tel_movil, tel_fijo, codigo)
			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)");

		if (empty($query)) {throw new Exception("No se encuentra {$this->tabla1}");}

		return $query->result();

	}

	public function cantidad_elementos() {
		$query = $this->db->query("SELECT coalesce(count(*),0) as count FROM {$this->tabla1} t1 join {$this->tabla2} t2 ON t1.id_cuenta = t2.id_cuenta  WHERE t2.dado_de_baja=0");
		return $query->row_array()["count"];
	}

	public function cantidad_paginas($elementos_por_pagina) {
		return ceil($this->cantidad_elementos() / $elementos_por_pagina);
	}

}