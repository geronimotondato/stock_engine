<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function __construct(){

		parent::__construct(); 
	}

	public function guardar_cliente($cliente){

		$this->db->trans_start();
		
		$this->db->insert('cliente', $cliente);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		   throw new Exception("No se pudo guardar el cliente en la base de datos");
		}
	}

	public function actualizar_cliente($cliente){

		$this->db->trans_start();

		//trae el campo "dado_de_baja" del registro cliente que se pretende actualizar
		$this->db->select('dado_de_baja');
		$query = $this->db->get_where('cliente', array('id_cliente' => $cliente["id_cliente"]) );

		//pregunto si el cliente está dado de baja, en cuyo caso finalizo la actualizacion
		if ($query->row()->dado_de_baja == TRUE){
			$this->db->trans_complete();
			throw new Exception("No puede actualizar un cliente dado de baja");
		}

		//actualizo el cliente
		$this->db->where('id_cliente', $cliente["id_cliente"]);
		$this->db->update('cliente', $cliente);

		$this->db->trans_complete();

		//chequeo si la transaccion falló en cuyo caso lanzo una excepcion
		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo actualizar el cliente en la base de datos");
		}
	}

	public function eliminar_cliente($id_cliente){

		$this->db->trans_start();

		$this->db->set('dado_de_baja', TRUE);
		$this->db->where('id_cliente', $id_cliente);
		$this->db->update('cliente');


		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		throw new Exception("No se pudo eliminar el cliente de la base de datos");
		}
	}

	public function get_cliente($id_cliente){

		$query = $this->db->query("SELECT * FROM cliente WHERE id_cliente = " . $id_cliente);

		if(empty($query->row())){ throw new Exception("El cliente no existe"); }

		return $query->row();
	}

	public function get_lista_clientes_completa(){


		$query = $this->db->query("select * from cliente where dado_de_baja=0");
		if(empty($query)){ throw new Exception("No hay clientes");}
		return $query->result();  
	}

	public function get_lista_clientes_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		$query = $this->db->query("select * from cliente where dado_de_baja=0 limit ".$limit." offset ".$offset);

		if(empty($query)){ throw new Exception("No hay clientes");}

		return $query->result();

		return $return;  

	}

	public function cantidad_clientes(){
		$query = $this->db->query("select count(*) from cliente where dado_de_baja=0");
		return $query->row_array()["count(*)"];
	}
	
	public function cantidad_paginas($clientes_por_pagina){
		return ceil($this->cantidad_clientes() / $clientes_por_pagina);		
	}

}