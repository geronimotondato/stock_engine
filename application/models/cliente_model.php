<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	var $tabla;
	var $id_column;

	public function __construct(){

		$this->tabla = "cliente";
		$this->id_column = "id_cliente";

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

		//trae el campo "dado_de_baja" y "saldo" del cliente que se pretende actualizar
		$this->db->select('dado_de_baja, saldo');
		$query = $this->db->get_where($this->tabla, array($this->id_column => $elemento[$this->id_column]) );

		//pregunto si el cliente está dado de baja, en cuyo caso finalizo la actualizacion
		if ($query->row()->dado_de_baja == TRUE){
			$this->db->trans_complete();
			throw new Exception("No puede actualizar un {$this->tabla} dado de baja");
		}

		//actualizo el saldo del cliente sumando el valor "saldo" de la BD 
		//con el valor "saldo" que viene por el pedido
		//que es el resultado de $sumar - $restar
		$elemento["saldo"] = $elemento["saldo"] + $query->row()->saldo;

		//actualizo el cliente
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

			$this->db->set('dado_de_baja', TRUE);
			$this->db->where($this->id_column, $id_elemento);
			$this->db->update($this->tabla);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		throw new Exception("No se pudo eliminar {$this->tabla} de la base de datos");
		}
	}

	public function get_elemento($id_elemento){

		$query = $this->db->query("SELECT * FROM {$this->tabla} WHERE {$this->id_column} = " . $id_elemento);

		if(empty($query->row())){ throw new Exception("No existe {$this->tabla}"); }

		return $query->row();
	}

	public function get_lista_elementos_completa(){


		$query = $this->db->query("select * from {$this->tabla} WHERE dado_de_baja=0");
		if(empty($query)){ throw new Exception("No hay registros de {$this->tabla}");}
		return $query->result();  
	}

	public function get_lista_elementos_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		$query = $this->db->query("select * from {$this->tabla} where dado_de_baja=0 limit ".$limit." offset ".$offset);

		if(empty($query)){ throw new Exception("No hay registros de {$this->tabla}");}

		return $query->result();

		return $return;  

	}

	public function buscar_elemento($texto_busqueda){

		$query = $this->db->query(
			"SELECT * FROM {$this->tabla}
			 WHERE dado_de_baja=0 AND
			 MATCH(nombre, direccion, email, tel_movil, tel_fijo, codigo) 
			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)" );

			if(empty($query)){ throw new Exception("No se encuentra {$this->tabla}");}

			return $query->result();

	}

	public function cantidad_elementos(){
		$query = $this->db->query("select count(*) from {$this->tabla} where dado_de_baja=0");
		return $query->row_array()["count(*)"];
	}

	public function cantidad_paginas($elementos_por_pagina){
		return ceil($this->cantidad_elementos() / $elementos_por_pagina);		
	}

}