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
}
