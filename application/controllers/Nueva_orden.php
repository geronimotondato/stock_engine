<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nueva_orden extends CI_Controller {

	public function index()
	{
		if(isset($this->session->logged_in)){

		$this->load->model('producto_model');
		$this->load->model('cliente_model');


		$data["productos"] = $this->producto_model->get_lista_productos();
		$data["clientes"] = $this->cliente_model->get_lista_clientes();

		if (null !== $this->input->get("id_orden")){
					$this->load->model('orden_model');
					$data["orden"] = $this->orden_model->get_orden($this->input->get("id_orden"));

		}else{
			$data["orden"]["id_orden"] = 0;
			$data["orden"]["cliente"] = 0;
			$data["orden"]["fecha"] = date("Y-m-d");
			$data["orden"]["items"] = [];

		}

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','nueva_orden'));
		$this->load->view("nueva_orden.php", $data);
		$this->load->view("footer.php");

		}else{
			$this->load->view("login.php");	
		}
	}



	public function guardar(){

		try{

			$id_orden = $this->input->post("id_orden", TRUE);
			$cliente = $this->input->post("cliente", TRUE);
			$fecha   = $this->input->post("fecha",TRUE);
			$items   = $this->input->post("items",TRUE);

			if($id_orden == null || $cliente == null || $fecha == null || $items == null){

				var_dump($_POST);
				throw new Exception("Debe completar todos los campos");
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_orden', 'Id_orden', 'trim|required|numeric');
			$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required|numeric');
			$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_date_valid');

			foreach($items as $i => $value) {
				$this->form_validation->set_rules ('items['.$i.'][id_producto]', 'id_producto', 'trim|required|numeric');
				$this->form_validation->set_rules ('items['.$i.'][cantidad]', 'cantidad', 'trim|required|numeric');
				$this->form_validation->set_rules ('items['.$i.'][descuento]', 'descuento', 'trim|required|numeric');
			}

			if(!($this->form_validation->run())){
				throw new Exception("Algun/os no fueron ingresados correctamente");
			}

			$orden = array(
					"id_orden" => $id_orden,
					"cliente" => $cliente,
					"fecha"   => $fecha,
					"items"   => $items
			);

			$this->load->model("orden_model");

			($id_orden == 0)? $this->orden_model->guardar_orden($orden) : $this->orden_model->actualizar_orden($orden);

			redirect('/','refresh');

		}catch(Exception $e){
			echo validation_errors();
			echo $e->getMessage();
			echo "<pre>";
			var_dump($_POST);
			echo "</pre>";
		}

}

public function eliminar_orden(){


}


	public function date_valid($date)
	{
	  $parts = explode("-", $date);
	  if (count($parts) == 3) {      
	    if (checkdate($parts[1], $parts[2], $parts[0]))
	    {
	      return TRUE;
	    }
	  }
	  $this->form_validation->set_message('date_valid', 'The Date field must be yyyy/mm/dd and separated by -');
	  return false;
	}



}
