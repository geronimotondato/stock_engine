<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	public function finalizar_orden()
	{
		if(isset($this->session->logged_in)){
			
			$id_orden = $this->input->post("id_orden", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_orden', 'id_orden', 'trim|required|numeric');

			if(!($this->form_validation->run())){
				throw new Exception("No se puede procesar esta solicitud");
			}

			$this->load->model('orden_model');
			$this->orden_model->finalizar_orden($id_orden);
			
			redirect('/','refresh');

			
		}else{
			$this->load->view("login.php");	
		}
	}
}

