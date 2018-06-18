<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends Member_Controller {

	public function index()
	{
			
			$this->load->model('producto_model');
			$data["productos"] = $this->producto_model->get_lista_productos();
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','productos'));
			$this->load->view("productos.php", $data);
			$this->load->view("footer.php");

	}
}

