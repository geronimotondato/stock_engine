<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($this->session->logged_in)){
			$this->load->view("header.php");
			$this->load->view("dashboard.php");
			$this->load->view("footer.php");
		}else{
			$this->load->view("login.php");	
		}
	}

		public function nueva_orden()
	{
		if(isset($this->session->logged_in)){
			$this->load->view("header.php");
			$this->load->view("nueva_orden.php");
			$this->load->view("footer.php");
		}else{
			$this->load->view("login.php");	
		}
	}
}
