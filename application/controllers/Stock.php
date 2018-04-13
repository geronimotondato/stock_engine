<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function index()
	{
		if(isset($this->session->logged_in)){
			
			$this->load->model('producto_model');
			$this->producto_model->get_lista_productos();
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','stock'));
			$this->load->view("stock.php");
			$this->load->view("footer.php");
		}else{
			$this->load->view("login.php");	
		}
	}
}

