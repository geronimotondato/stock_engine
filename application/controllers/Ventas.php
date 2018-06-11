<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends Member_Controller {

	public function index()
	{

		$this->load->model('venta_model');

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules('pagina_actual','Pagina actual', 'required|trim|greater_than[0]');

		$pagina_actual = ($this->form_validation->run() == FALSE)? 1 : $this->input->get('pagina_actual', TRUE);

		$ventas_por_pagina = 10;

		$cantidad_paginas_totales = $this->venta_model->cantidad_paginas($ventas_por_pagina);

		$data["ventas"] = $this->venta_model->get_lista_ventas_pagina(
													$pagina_actual,
													$ventas_por_pagina
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

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','ventas'));
		$this->load->view("ventas.php", $data);
		$this->load->view("footer.php");

	}

	public function abm_venta()	{

		$this->load->model('producto_model');
		$this->load->model('cliente_model');

		$data["productos"] = $this->producto_model->get_lista_productos();
		$data["clientes"] = $this->cliente_model->get_lista_elementos_completa();

		if (null == $this->input->get("id_venta")){

			$data["venta"]["id_venta"] = 0;
			$data["venta"]["cliente"] = 0;
			$data["venta"]["fecha"] = date("Y-m-d");
			$data["venta"]["items"] = [];

		}else{

			$this->load->model('venta_model');
			$data["venta"] = $this->venta_model->get_venta($this->input->get("id_venta"));

			if(!(isset($data["venta"]))){
				echo "Error 404. Page not found";
				exit();
			}
		}

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','venta'));
		$this->load->view("abm_venta.php", $data);
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

			$venta = array(
				"id_cliente" => $id_cliente,
				"fecha"      => $fecha,
				"items"      => $items
			);

			$this->load->model("venta_model");
			$productos_sin_disponibilidad = $this->venta_model->guardar_venta($venta);

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

			$id_venta = $this->input->post("id_venta", TRUE);
			$fecha    = $this->input->post("fecha",TRUE);

			if(isset($_POST["items"])){
					$items = $this->input->post("items",TRUE);
			}else{
					throw new Exception("Debe ingresar al menos un producto");
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_venta', 'id_venta', 'trim|required|numeric');
			$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|callback_date_valid');

			foreach($items as $i => $value) {
				$this->form_validation->set_rules('items['.$i.'][id_producto]', 'id_producto', 'trim|required|numeric');
				$this->form_validation->set_rules('items['.$i.'][cantidad]', 'cantidad', 'trim|required|numeric');
				$this->form_validation->set_rules('items['.$i.'][descuento]', 'descuento', 'trim|required|numeric');
			}

			if(!($this->form_validation->run())){
				throw new Exception("No ingresó correctamente la información requerida");
			}

			$venta = array(
				"id_venta" =>$id_venta,
				"fecha"    => $fecha,
				"items"    => $items
			);

			$this->load->model("venta_model");
			$productos_sin_disponibilidad = $this->venta_model->actualizar_venta($venta);

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

			$id_venta = $this->input->post("id_venta", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_venta', 'id_venta', 'trim|required|numeric');

			if(!($this->form_validation->run())){
				throw new Exception("No se pudo finalizar esta venta, vuelva a intentarlo mas tarde");
			}

			$this->load->model("venta_model");
			$this->venta_model->eliminar_venta($id_venta);

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

			$id_venta = $this->input->post("id_venta", TRUE);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_venta', 'id_venta', 'trim|required|numeric');

			if(!($this->form_validation->run())){
				throw new Exception("No se pudo finalizar esta venta, vuelva a intentarlo mas tarde");
			}

			$this->load->model('venta_model');
			$this->venta_model->finalizar_venta($id_venta);
			
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