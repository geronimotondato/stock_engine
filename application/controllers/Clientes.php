<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function index()
	{
		if(isset($this->session->logged_in)){
			
			// $this->load->model('producto_model');
			// $data["productos"] = $this->producto_model->get_stock_productos();
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','clientes'));
			$this->load->view("lista_clientes.php", $data);
			$this->load->view("footer.php");
		}else{
			$this->load->view("login.php");	
		}
	}


	public function abm_cliente(){
		if(isset($this->session->logged_in)){

			$id_cliente  = $this->input->get('id_cliente', TRUE);

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



		}else{
			$this->load->view("login.php");	
		}
	}


	public function guardar(){

		$this->guardar_actualizar("guardar");
	
	}

	public function actualizar(){

		$this->guardar_actualizar("actualizar");
	
	}

	public function eliminar(){

		try{
			$nombre = $this->input->post("nombre", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');

			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$this->load->model('cliente_model');
			$this->cliente_model->eliminar_cliente($nombre);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);


		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();

			echo json_encode($respuesta);
		}

	}

	private function guardar_actualizar($accion){

		try{

			$nombre         = $this->input->post("nombre", TRUE);
			$direccion      = $this->input->post("direccion",TRUE);
			$tel_movil      = $this->input->post("tel_movil",TRUE);
			$tel_fijo       = $this->input->post("tel_fijo",TRUE);
			$email          = $this->input->post("email",TRUE);
			$saldo_deudor   = $this->input->post("saldo_deudor",TRUE);
			$saldo_acreedor = $this->input->post("saldo_acreedor",TRUE);


			$this->load->library('form_validation');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
			$this->form_validation->set_rules('direccion', 'Dirección', 'trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('tel_movil', 'Tel movil', 'trim|numeric');
			$this->form_validation->set_rules('tel_fijo', 'Tel fijo', 'trim|numeric');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
			$this->form_validation->set_rules('saldo_deudor', 'Saldo Deudor', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('saldo_acreedor', 'Saldo acreedor', 'trim|greater_than_equal_to[0]');


			if(!($this->form_validation->run())){
				throw new Exception(validation_errors());
			}

			$cliente = array(
			"nombre"=>$nombre,
			"direccion"=>$direccion,
			"tel_movil"=>$tel_movil,
			"tel_fijo"=>$tel_fijo,
			"email"=>$email,
			"saldo_deudor"=>$saldo_deudor,
			"saldo_acreedor"=>$saldo_acreedor,
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

}

