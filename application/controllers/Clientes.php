<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends Member_Controller {

	public function index(){

		$this->load->model('cliente_model');

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules('pagina_actual', 'Pagina actual', 'required|trim|greater_than[0]');

		$pagina_actual = ($this->form_validation->run() == FALSE)? 1 : $this->input->get('pagina_actual', TRUE);

		$clientes_por_pagina = 10;

		$cantidad_paginas_totales = $this->cliente_model->cantidad_paginas($clientes_por_pagina);

		$data["clientes"]  = $this->cliente_model->get_lista_clientes_pagina(
												 		$pagina_actual, 
														$clientes_por_pagina
												 );

		$data["paginador"] = $this->load->view(
			"paginador.php",
			array (
					"link"                     => "clientes",
					"pagina_actual"            => $pagina_actual,
					"cantidad_paginas_totales" => $cantidad_paginas_totales,
					"rango"                    => calcular_rango_paginador($pagina_actual, 
																		   $cantidad_paginas_totales, 7)
			),
			TRUE
		);
			
		$this->load->view("header.php", $this->session->set_flashdata('side_bar','clientes'));
		$this->load->view("lista_clientes.php", $data);
		$this->load->view("footer.php");
			
	}


	public function abm_cliente(){
	
			$this->form_validation->set_data($_GET);
			$this->form_validation->set_rules('id_cliente', 'id_cliente', 'required|trim|greater_than_equal_to[0]');

			if($this->form_validation->run() == FALSE){
				$id_cliente = null;
			}else{
				$id_cliente  = $this->input->get('id_cliente', TRUE);
			}
		

			if(isset($id_cliente)){

				try{

					$this->load->model('cliente_model');
					$data["cliente"] = $this->cliente_model->get_cliente($id_cliente);

					$this->load->view("header.php");
					$this->load->view("abm_cliente.php", $data);
					$this->load->view("footer.php");

				}catch(Exception $e){
					echo $e->getMessage();
				}

			}else{
					$this->load->view("header.php");
					$this->load->view("abm_cliente.php");
					$this->load->view("footer.php");
			}
	}

	public function guardar(){

		$this->guardar_actualizar("guardar");
	
	}

	public function actualizar(){

		$this->guardar_actualizar("actualizar");
	
	}

	private function guardar_actualizar($accion){

		try{

			$id_cliente = $this->input->post("id_cliente", TRUE);
			$nombre     = $this->input->post("nombre", TRUE);
			$direccion  = $this->input->post("direccion",TRUE);
			$tel_movil  = $this->input->post("tel_movil",TRUE);
			$tel_fijo   = $this->input->post("tel_fijo",TRUE);
			$email      = $this->input->post("email",TRUE);
			$saldo      = $this->input->post("saldo",TRUE);
			$sumar      = $this->input->post("sumar",TRUE);
			$restar      = $this->input->post("restar",TRUE);

			$this->form_validation->set_rules('id_cliente', 'id_cliente', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('direccion', 'Dirección', 'trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('tel_movil', 'Tel movil', 'trim|numeric');
			$this->form_validation->set_rules('tel_fijo', 'Tel fijo', 'trim|numeric');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
			$this->form_validation->set_rules('saldo', 'Saldo', 'trim|numeric');
			$this->form_validation->set_rules('sumar', 'Sumar', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('restar', 'Restar', 'trim|greater_than_equal_to[0]');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$cliente = array(
				"id_cliente" => $id_cliente,
				"nombre"     =>$nombre,
				"direccion"  =>$direccion,
				"tel_movil"  =>$tel_movil,
				"tel_fijo"   =>$tel_fijo,
				"email"      =>$email,
				"saldo"      =>$saldo + ($sumar - $restar),

			);

			$this->load->model('cliente_model');

			switch ($accion) {

				case 'guardar':
						$this->cliente_model->guardar_cliente($cliente);
					break;

				case 'actualizar':
						$this->cliente_model->actualizar_cliente($cliente);
					break;
			}

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
			$id_cliente = $this->input->post("id_cliente", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_cliente', 'id_cliente', 'trim|greater_than[0]|required');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$this->load->model('cliente_model');
			$this->cliente_model->eliminar_cliente($id_cliente);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);


		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();

			echo json_encode($respuesta);
		}

	}

	public function buscar_cliente(){

		$texto_busqueda = (isset($_POST["texto_busqueda"]))? $this->input->post("texto_busqueda", TRUE) : "";

		if($texto_busqueda != ""){

			$this->load->model('cliente_model');

			try{

				$resultado = $this->cliente_model->buscar_cliente($texto_busqueda);
				$data["clientes"]  = $resultado;
				$data["texto_busqueda"] = $texto_busqueda;

			}catch(Exception $e){
				$data["clientes"] = NULL;
				$data["texto_busqueda"] = NULL;
			}
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','clientes'));
			$this->load->view("lista_clientes.php", $data);
			$this->load->view("footer.php");

		}else{

			$this->index();

		}


	}

}

