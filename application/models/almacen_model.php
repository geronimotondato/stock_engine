<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class almacen_model extends CI_Model {

	public function __construct(){

		parent::__construct(); 
	}

	public function guardar_almacen($almacen){

		$this->db->trans_start();
		
		$this->db->insert('almacen', $almacen);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		   throw new Exception("No se pudo guardar el almacen en la base de datos");
		}
	}

	public function actualizar_almacen($almacen){

		$this->db->trans_start();

		$this->db->where('id_almacen', $almacen["id_almacen"]);
		$this->db->update('almacen', $almacen);

		$this->db->trans_complete();


		//chequeo si la transaccion falló en cuyo caso lanzo una excepcion
		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo actualizar la almacen en la base de datos");
		}
	}

	public function eliminar_almacen($id_almacen){

		$this->db->trans_start();

		//pongo en null el id_almacen de los productos que pertenecen a la almacen que va a ser elimina
		$this->db->set('id_almacen', NULL);
		$this->db->where('id_almacen', $id_almacen);
		$this->db->update('producto');

		//Elimino el almacen
		$this->db->where('id_almacen', $id_almacen);
		$this->db->delete('almacen');


		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		throw new Exception("No se pudo eliminar el almacen de la base de datos");
		}
	}

	public function get_almacen($id_almacen){

		$query = $this->db->query("SELECT * FROM almacen WHERE id_almacen = " . $id_almacen);

		if(empty($query->row())){ throw new Exception("La almacen no existe"); }

		return $query->row();
	}

	public function get_lista_almacenes_completa(){


		$query = $this->db->query("select * from almacen");
		if(empty($query)){ throw new Exception("No hay almacenes");}
		return $query->result();  
	}

	public function get_lista_almacenes_pagina($numero_pagina, $elementos_por_pagina){

		$limit = $elementos_por_pagina;
		$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

		$query = $this->db->query("select * from almacen limit ".$limit." offset ".$offset);

		if(empty($query)){ throw new Exception("No hay almacenes");}

		return $query->result();

		return $return;  

	}

	public function buscar_almacen($texto_busqueda){

		$query = $this->db->query(
			"SELECT * FROM almacen WHERE
			 MATCH(nombre, direccion, telefono) 
			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)" );

			if(empty($query)){ throw new Exception("No se encuentran almacenes");}

			return $query->result();

	}

	public function cantidad_almacenes(){
		$query = $this->db->query("select count(*) from almacen");
		return $query->row_array()["count(*)"];
	}
	
	public function cantidad_paginas($almacenes_por_pagina){
		return ceil($this->cantidad_almacenes() / $almacenes_por_pagina);		
	}

}