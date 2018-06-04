<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class categoria_model extends CI_Model {

	public function __construct(){

		parent::__construct(); 
	}

	public function guardar_categoria($categoria){

		$this->db->trans_start();
		
		$this->db->insert('categoria', $categoria);

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		   throw new Exception("No se pudo guardar la categoria en la base de datos");
		}
	}

	public function actualizar_categoria($categoria){

		$this->db->trans_start();

		$this->db->where('id_categoria', $categoria["id_categoria"]);
		$this->db->update('categoria', $categoria);

		$this->db->trans_complete();


		//chequeo si la transaccion falló en cuyo caso lanzo una excepcion
		if($this->db->trans_status() === FALSE){
			throw new Exception("No se pudo actualizar la categoria en la base de datos");
		}
	}

	public function eliminar_categoria($id_categoria){

		$this->db->trans_start();

		//pongo en null el id_categoria de los productos que pertenecen a la categoria que va a ser elimina
		$this->db->set('id_categoria', NULL);
		$this->db->where('id_categoria', $id_categoria);
		$this->db->update('producto');

		//Elimino la categoria
		$this->db->where('id_categoria', $id_categoria);
		$this->db->delete('categoria');


		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
		throw new Exception("No se pudo eliminar el categoria de la base de datos");
		}
	}

	public function get_categoria($id_categoria){

		$query = $this->db->query("SELECT * FROM categoria WHERE id_categoria = " . $id_categoria);

		if(empty($query->row())){ throw new Exception("La categoria no existe"); }

		return $query->row();
	}

	// public function get_lista_categorias_completa(){


	// 	$query = $this->db->query("select * from categoria where dado_de_baja=0");
	// 	if(empty($query)){ throw new Exception("No hay categorias");}
	// 	return $query->result();  
	// }

	// public function get_lista_categorias_pagina($numero_pagina, $elementos_por_pagina){

	// 	$limit = $elementos_por_pagina;
	// 	$offset = ($numero_pagina * $elementos_por_pagina) - $elementos_por_pagina;

	// 	$query = $this->db->query("select * from categoria where dado_de_baja=0 limit ".$limit." offset ".$offset);

	// 	if(empty($query)){ throw new Exception("No hay categorias");}

	// 	return $query->result();

	// 	return $return;  

	// }

	// public function buscar_categoria($texto_busqueda){

	// 		$query = $this->db->query(
	// 			"SELECT * FROM categoria
	// 			 WHERE dado_de_baja=0 
	// 			 AND MATCH(nombre, direccion, email, tel_movil, tel_fijo) 
	// 			 AGAINST(\"" . $texto_busqueda . "*\" IN BOOLEAN MODE)" );

	// 			if(empty($query)){ throw new Exception("No se encuentran categorias");}

	// 			return $query->result();

	// }

	// public function cantidad_categorias(){
	// 	$query = $this->db->query("select count(*) from categoria where dado_de_baja=0");
	// 	return $query->row_array()["count(*)"];
	// }
	
	// public function cantidad_paginas($categorias_por_pagina){
	// 	return ceil($this->cantidad_categorias() / $categorias_por_pagina);		
	// }

}