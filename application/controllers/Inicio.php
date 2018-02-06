<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		if(isset($this->session->logged_in)){


		$this->load->model('orden_model');

		$data["ordenes"] = $this->orden_model->get_orden_list(5,9999999999);

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','incio'));
		$this->load->view("inicio.php", $data);
		$this->load->view("footer.php");

		}else{
			$this->load->view("login.php");	
		}
	}
}




