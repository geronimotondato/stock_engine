<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends Member_Controller {

	public function index()
	{

		$this->load->model('orden_model');

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules('pagina_actual','Pagina actual', 'required|trim|greater_than[0]');

		$pagina_actual = ($this->form_validation->run() == FALSE)? 1 : $this->input->get('pagina_actual', TRUE);

		$ordenes_por_pagina = 10;

		$cantidad_paginas_totales = $this->orden_model->cantidad_paginas($ordenes_por_pagina);

		$data["ordenes"] = $this->orden_model->get_lista_ordenes_pagina(
													$pagina_actual,
													$ordenes_por_pagina
											 );

		$data["paginador"] = $this->load->view(
			"paginador.php",
			array (
					"link"                     => "",
					"pagina_actual"            => $pagina_actual,
					"cantidad_paginas_totales" => $cantidad_paginas_totales,
					"rango"                    => calcular_rango_paginador($pagina_actual, 
																				$cantidad_paginas_totales, 7)
			),
			TRUE
		);

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','ordenes'));
		$this->load->view("ordenes.php", $data);
		$this->load->view("footer.php");

	}

	public function abm_orden()	{

		$this->load->model('producto_model');
		$this->load->model('cliente_model');

		$data["productos"] = $this->producto_model->get_lista_productos();
		$data["clientes"] = $this->cliente_model->get_lista_clientes_completa();

		if (null == $this->input->get("id_orden")){

			$data["orden"]["id_orden"] = 0;
			$data["orden"]["cliente"] = 0;
			$data["orden"]["fecha"] = date("Y-m-d");
			$data["orden"]["items"] = [];

		}else{

			$this->load->model('orden_model');
			$data["orden"] = $this->orden_model->get_orden($this->input->get("id_orden"));

			if(!(isset($data["orden"]))){
				echo "Error 404. Page not found";
				exit();
			}
		}

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','orden'));
		$this->load->view("abm_orden.php", $data);
		$this->load->view("footer.php");
	}


	public function guardar(){

		try{

			$id_cliente = $this->input->post("id_cliente", TRUE);
			$fecha      = $this->input->post("fecha",TRUE);

			if(isset($_POST["items"])){
					$items = $this->input->post("items",TRUE);
			}else{
					throw new Exception("Debe ingresar al menos un producto");
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_cliente', 'id_cliente', 'trim|required|numeric');
			$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_date_valid');

			foreach($items as $i => $value) {
				$this->form_validation->set_rules ('items['.$i.'][id_producto]', 'id_producto', 'trim|required|numeric');
				$this->form_validation->set_rules ('items['.$i.'][cantidad]', 'cantidad', 'trim|required|numeric');
				$this->form_validation->set_rules ('items['.$i.'][descuento]', 'descuento', 'trim|required|numeric');
			}

			if(!($this->form_validation->run())){
				throw new Exception("No ingresó correctamente la información requerida");
			}

			$orden = array(
				"id_cliente" => $id_cliente,
				"fecha"      => $fecha,
				"items"      => $items
			);

			$this->load->model("orden_model");
			$productos_sin_disponibilidad = $this->orden_model->guardar_orden($orden);

			if(!(isset($productos_sin_disponibilidad))){
				$respuesta["estado"] = "ok";
				echo json_encode($respuesta);
			}else{
				$respuesta["estado"]    = "sin_stock";
				$respuesta["faltantes"] = $productos_sin_disponibilidad;
				echo json_encode($respuesta);
			}
		}catch(Exception $e){
			$respuesta["estado"]  = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);
		}
	}


	public function actualizar(){

		try{

			$id_orden = $this->input->post("id_orden", TRUE);
			$fecha    = $this->input->post("fecha",TRUE);

			if(isset($_POST["items"])){
					$items = $this->input->post("items",TRUE);
			}else{
					throw new Exception("Debe ingresar al menos un producto");
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_orden', 'id_orden', 'trim|required|numeric');
			$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_date_valid');

			foreach($items as $i => $value) {
				$this->form_validation->set_rules('items['.$i.'][id_producto]', 'id_producto', 'trim|required|numeric');
				$this->form_validation->set_rules('items['.$i.'][cantidad]', 'cantidad', 'trim|required|numeric');
				$this->form_validation->set_rules('items['.$i.'][descuento]', 'descuento', 'trim|required|numeric');
			}

			if(!($this->form_validation->run())){
				throw new Exception("No ingresó correctamente la información requerida");
			}

			$orden = array(
				"id_orden" =>$id_orden,
				"fecha"    => $fecha,
				"items"    => $items
			);

			$this->load->model("orden_model");
			$productos_sin_disponibilidad = $this->orden_model->actualizar_orden($orden);

			if(!(isset($productos_sin_disponibilidad))){
				$respuesta["estado"] = "ok";
				echo json_encode($respuesta);
			}else{
				$respuesta["estado"] = "sin_stock";
				$respuesta["faltantes"] = $productos_sin_disponibilidad;
				echo json_encode($respuesta);
			}

		}catch(Exception $e){
			$respuesta["estado"]  = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);
		}
	}

	public function eliminar(){

		try{

			$id_orden = $this->input->post("id_orden", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_orden', 'id_orden', 'trim|required|numeric');

			if(!($this->form_validation->run())){
				throw new Exception("No se pudo finalizar esta orden, vuelva a intentarlo mas tarde");
			}

			$this->load->model("orden_model");
			$this->orden_model->eliminar_orden($id_orden);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		}catch(Exception $e){

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);
		}
	}

	public function finalizar(){

		try{

			$id_orden = $this->input->post("id_orden", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_orden', 'id_orden', 'trim|required|numeric');

			if(!($this->form_validation->run())){
				throw new Exception("No se pudo finalizar esta orden, vuelva a intentarlo mas tarde");
			}

			$this->load->model('orden_model');
			$this->orden_model->finalizar_orden($id_orden);
			
			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);	

		}catch(Exception $e){
			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);
		}
	}

	function date_valid($date){
		$parts = explode("-", $date);
		if (count($parts) == 3) {      
			if (checkdate($parts[1], $parts[2], $parts[0]))
			{
				return TRUE;
			}
		}
		$this->form_validation->set_message('date_valid', 'El campo fecha debe tener el formato dd/mm/yyyy separa por -');
		return false;
	}

}