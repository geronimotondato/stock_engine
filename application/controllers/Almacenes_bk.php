<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Almacenes extends Member_Controller {

	public function index(){

		$this->load->model('almacen_model');

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules('pagina_actual', 'Pagina actual', 'required|trim|greater_than[0]');

		$pagina_actual = ($this->form_validation->run() == FALSE)? 1 : $this->input->get('pagina_actual', TRUE);

		$almacenes_por_pagina = 10;

		$cantidad_paginas_totales = $this->almacen_model->cantidad_paginas($almacenes_por_pagina);

		$data["almacenes"]  = $this->almacen_model->get_lista_almacenes_pagina(
												 		$pagina_actual, 
														$almacenes_por_pagina
												 );

		$data["paginador"] = $this->load->view(
			"paginador.php",
			array (
					"link"                     => "almacenes",
					"pagina_actual"            => $pagina_actual,
					"cantidad_paginas_totales" => $cantidad_paginas_totales,
					"rango"                    => calcular_rango_paginador($pagina_actual, 
																		   $cantidad_paginas_totales, 7)
			),
			TRUE
		);
			
		$this->load->view("header.php", $this->session->set_flashdata('side_bar','almacenes'));
		$this->load->view("almacenes.php", $data);
		$this->load->view("footer.php");
			
	}


	public function abm_almacen(){
	

			$this->form_validation->set_data($_GET);
			$this->form_validation->set_rules('id_almacen', 'id_almacen', 'required|trim|greater_than_equal_to[0]');

			if($this->form_validation->run() == FALSE){
				$id_almacen = null;
			}else{
				$id_almacen  = $this->input->get('id_almacen', TRUE);
			}
		
			if(isset($id_almacen)){

				try{

					$this->load->model('almacen_model');
					$data["almacen"] = $this->almacen_model->get_almacen($id_almacen);

					$this->load->view("header.php");
					$this->load->view("abm_almacen.php", $data);
					$this->load->view("footer.php");

				}catch(Exception $e){
					echo $e->getMessage();
				}

			}else{
					$this->load->view("header.php");
					$this->load->view("abm_almacen.php");
					$this->load->view("footer.php");
			}
	}


	public function guardar(){

		try{

			$nombre    = $this->input->post("nombre", TRUE);
			$direccion = $this->input->post("direccion",TRUE);
			$telefono  = $this->input->post("telefono",TRUE);

			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('direccion', 'direccion', 'trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('telefono', 'telefono', 'trim|alpha_numeric_spaces');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$almacen = array(
				"nombre"    =>$nombre,
				"direccion" =>$direccion,
				"telefono"  => $telefono,
			);

			$this->load->model('almacen_model');
			$this->almacen_model->guardar_almacen($almacen);
		
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

			$id_almacen = $this->input->post("id_almacen", TRUE);
			$nombre       = $this->input->post("nombre", TRUE);
			$direccion  = $this->input->post("direccion",TRUE);
			$telefono  = $this->input->post("telefono",TRUE);

			$this->form_validation->set_rules('id_almacen', 'id_almacen', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('direccion', 'Descripción', 'trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('telefono', 'telefono', 'trim|alpha_numeric_spaces');
	
			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$almacen = array(
				"id_almacen" => $id_almacen,
				"nombre"     =>$nombre,
				"direccion"  =>$direccion,
				"telefono"   => $telefono,
			);

			$this->load->model('almacen_model');
			$this->almacen_model->actualizar_almacen($almacen);

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
			$id_almacen = $this->input->post("id_almacen", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_almacen', 'id_almacen', 'trim|greater_than[0]|required');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$this->load->model('almacen_model');
			$this->almacen_model->eliminar_almacen($id_almacen);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);


		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();

			echo json_encode($respuesta);
		}

	}

	public function buscar_almacen(){

		$texto_busqueda = (isset($_POST["texto_busqueda"]))? $this->input->post("texto_busqueda", TRUE) : "";

		if($texto_busqueda != ""){

			$this->load->model('almacen_model');

			try{

				$resultado = $this->almacen_model->buscar_almacen($texto_busqueda);
				$data["almacenes"]  = $resultado;
				$data["texto_busqueda"] = $texto_busqueda;

			}catch(Exception $e){
				$data["almacenes"] = NULL;
				$data["texto_busqueda"] = NULL;
			}
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','almacenes'));
			$this->load->view("almacenes.php", $data);
			$this->load->view("footer.php");

		}else{

			$this->index();

		}


	}

}