<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nueva_orden extends CI_Controller {

	public function index()
	{
		if(isset($this->session->logged_in)){

		$this->load->model('producto_model');
		$data["productos"] = $this->producto_model->get_lista_productos();
		$this->load->model('cliente_model');
		$data["clientes"] = $this->cliente_model->get_lista_clientes();

		$this->load->view("header.php", $this->session->set_flashdata('header_tab','nueva_orden'));
		$this->load->view("nueva_orden.php", $data);
		$this->load->view("footer.php");

		}else{
			$this->load->view("login.php");	
		}
	}

	public function guardar()
	{

		print_r($_POST);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required|numeric');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required');
		$lista_item =$this->input->post('item', TRUE);
		for( $i = 0; $i < count($_POST["item"]["id_producto"]); $i++)
		{
			$this->form_validation->set_rules ('item[id_producto]['.$i.']', 'id_producto', 'trim|required|numeric');
			$this->form_validation->set_rules ('item[cantidad]['.$i.']', 'cantidad', 'trim|required|numeric');
			$this->form_validation->set_rules ('item[descuento]['.$i.']', 'descuento', 'trim|required|numeric');
		}
		// try{
		// 	if(!($this->form_validation->run())){
		// 		throw new Exception("Los input no pasan la validacion");
		// 	}

		// 	redirect('/', 'refresh');
		// }catch(Exception $e){
		// 	redirect('/', 'refresh');
		// }
	}



}
