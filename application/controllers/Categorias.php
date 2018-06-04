<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends Member_Controller {

	// public function index(){

	// 	$this->load->model('categoria_model');

	// 	$this->form_validation->set_data($_GET);
	// 	$this->form_validation->set_rules('pagina_actual', 'Pagina actual', 'required|trim|greater_than[0]');

	// 	$pagina_actual = ($this->form_validation->run() == FALSE)? 1 : $this->input->get('pagina_actual', TRUE);

	// 	$categorias_por_pagina = 10;

	// 	$cantidad_paginas_totales = $this->categoria_model->cantidad_paginas($categorias_por_pagina);

	// 	$data["categorias"]  = $this->categoria_model->get_lista_categorias_pagina(
	// 											 		$pagina_actual, 
	// 													$categorias_por_pagina
	// 											 );

	// 	$data["paginador"] = $this->load->view(
	// 		"paginador.php",
	// 		array (
	// 				"link"                     => "categorias",
	// 				"pagina_actual"            => $pagina_actual,
	// 				"cantidad_paginas_totales" => $cantidad_paginas_totales,
	// 				"rango"                    => calcular_rango_paginador($pagina_actual, 
	// 																	   $cantidad_paginas_totales, 7)
	// 		),
	// 		TRUE
	// 	);
			
	// 	$this->load->view("header.php", $this->session->set_flashdata('side_bar','categorias'));
	// 	$this->load->view("categorias.php", $data);
	// 	$this->load->view("footer.php");
			
	// }


	public function abm_categoria(){
	

			$this->form_validation->set_data($_GET);
			$this->form_validation->set_rules('id_categoria', 'id_categoria', 'required|trim|greater_than_equal_to[0]');

			if($this->form_validation->run() == FALSE){
				$id_categoria = null;
			}else{
				$id_categoria  = $this->input->get('id_categoria', TRUE);
			}
		
			if(isset($id_categoria)){

				try{

					$this->load->model('categoria_model');
					$data["categoria"] = $this->categoria_model->get_categoria($id_categoria);

					$this->load->view("header.php");
					$this->load->view("abm_categoria.php", $data);
					$this->load->view("footer.php");

				}catch(Exception $e){
					echo $e->getMessage();
				}

			}else{
					$this->load->view("header.php");
					$this->load->view("abm_categoria.php");
					$this->load->view("footer.php");
			}
	}


	public function guardar(){

		try{

			$nombre       = $this->input->post("nombre", TRUE);
			$descripcion  = $this->input->post("descripcion",TRUE);

			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|alpha_numeric_spaces');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$categoria = array(
				"nombre"       =>$nombre,
				"descripcion"  =>$descripcion
			);

			$this->load->model('categoria_model');
			$this->categoria_model->guardar_categoria($categoria);
		
			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);

		}
	}


	public function actualizar(){

		try{

			$id_categoria = $this->input->post("id_categoria", TRUE);
			$nombre       = $this->input->post("nombre", TRUE);
			$descripcion  = $this->input->post("descripcion",TRUE);

			$this->form_validation->set_rules('id_categoria', 'id_categoria', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|alpha_numeric_spaces');
	
			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$categoria = array(
				"id_categoria" => $id_categoria,
				"nombre"       =>$nombre,
				"descripcion"  =>$descripcion
			);

			$this->load->model('categoria_model');
			$this->categoria_model->actualizar_categoria($categoria);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);

		}

	}


	public function eliminar(){

		try{
			$id_categoria = $this->input->post("id_categoria", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_categoria', 'id_categoria', 'trim|greater_than[0]|required');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$this->load->model('categoria_model');
			$this->categoria_model->eliminar_categoria($id_categoria);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);


		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();

			echo json_encode($respuesta);
		}

	}

	// public function buscar_categoria(){

	// 	$texto_busqueda = (isset($_POST["texto_busqueda"]))? $this->input->post("texto_busqueda", TRUE) : "";

	// 	if($texto_busqueda != ""){

	// 		$this->load->model('categoria_model');

	// 		try{

	// 			$resultado = $this->categoria_model->buscar_categoria($texto_busqueda);
	// 			$data["categorias"]  = $resultado;
	// 			$data["texto_busqueda"] = $texto_busqueda;

	// 		}catch(Exception $e){
	// 			$data["categorias"] = NULL;
	// 			$data["texto_busqueda"] = NULL;
	// 		}
			
	// 		$this->load->view("header.php", $this->session->set_flashdata('side_bar','categorias'));
	// 		$this->load->view("categorias.php", $data);
	// 		$this->load->view("footer.php");

	// 	}else{

	// 		$this->index();

	// 	}


	// }

}