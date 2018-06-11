<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class categoria_model extends CI_Model {

	var $tabla;
	var $id_column;

	public function __construct(){

		$this->tabla = "categoria";
		$this->id_column = "id_categoria";

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

		$query = $this->db->query("SELECT * FROM {$this->tabla} WHERE {$this->id_column} = " . $id_elemento);

		if(empty($query->row())){ throw new Exception("No existe {$this->tabla}"); }

		return $query->row();
	}

	public function get_lista_elementos_completa(){


		$query = $this->db->query("select * from {$this->tabla}");
		if(empty($query)){ throw new Exception("No hay registros de {$this->tabla}");}
		return $query->result();  
	}

	public function get_lista_elementos_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		$query = $this->db->query("select * from {$this->tabla} limit ".$limit." offset ".$offset);

		if(empty($query)){ throw new Exception("No hay registros de {$this->tabla}");}

		return $query->result();

		return $return;  

	}

	public function buscar_elemento($texto_busqueda){

		$query = $this->db->query(
			"SELECT * FROM {$this->tabla} WHERE
			 MATCH(nombre, descripcion, codigo) 
			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)" );

			if(empty($query)){ throw new Exception("No se encuentra {$this->tabla}");}

			return $query->result();

	}

	public function cantidad_elementos(){
		$query = $this->db->query("select count(*) from {$this->tabla}");
		return $query->row_array()["count(*)"];
	}
	
	public function cantidad_paginas($elementos_por_pagina){
		return ceil($this->cantidad_elementos() / $elementos_por_pagina);		
	}

}