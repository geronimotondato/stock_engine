<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends Member_Controller {

	public function index(){

			$this->load->library('form_validation');
			$this->form_validation->set_data($_GET);
			$this->form_validation->set_rules(
				'numero_pagina', 
				'Numero de pagina',
				'required|trim|greater_than[0]'
			);

			if($this->form_validation->run() == FALSE){
				$numero_pagina = 1;
			}else{
				$numero_pagina = $this->input->get('numero_pagina', TRUE);
			}

			$this->load->model('cliente_model');

			$elementos_por_pagina = 10;

			$data["clientes"]  = $this->cliente_model->get_lista_clientes_pagina(
									$numero_pagina, 
									$elementos_por_pagina
								 );
			$p["seccion"] = "clientes";
			$p["numero_pagina"]    = $numero_pagina;
			$p["cantidad_paginas"] = ceil($this->cliente_model->cantidad_clientes()/$elementos_por_pagina);
			$p["rango"]            = calcular_rango_paginador(
										$p["numero_pagina"],
										$p["cantidad_paginas"],
										7
									 );	
			$data["paginador"] = $this->load->view("paginador.php", $p, TRUE);
				
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','clientes'));
			$this->load->view("lista_clientes.php", $data);
			$this->load->view("footer.php");
			
	}


	public function abm_cliente(){
	
			

			$this->load->library('form_validation');
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

			$id_cliente     = $this->input->post("id_cliente", TRUE);
			$nombre         = $this->input->post("nombre", TRUE);
			$direccion      = $this->input->post("direccion",TRUE);
			$tel_movil      = $this->input->post("tel_movil",TRUE);
			$tel_fijo       = $this->input->post("tel_fijo",TRUE);
			$email          = $this->input->post("email",TRUE);
			$saldo   = $this->input->post("saldo",TRUE);

			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_cliente', 'id_cliente', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('direccion', 'Dirección', 'trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('tel_movil', 'Tel movil', 'trim|numeric');
			$this->form_validation->set_rules('tel_fijo', 'Tel fijo', 'trim|numeric');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
			$this->form_validation->set_rules('saldo', 'Saldo Deudor', 'trim|numeric');

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
				"saldo"      =>$saldo,

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

}

