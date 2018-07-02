<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends Member_Controller {

	var $nombre_plural;
	var $nombre_singular;
	var $vista_listado;
	var $vista_abm;
	var $elemento;
	var $id_elemento;

	public function __construct() {
		parent::__construct();

		$this->load->model('producto_model', 'model');

		$this->nombre_plural = "productos";
		$this->nombre_singular = "producto";
		$this->vista_listado = "productos.php";
		$this->vista_abm = "abm_producto.php";

		try {

			switch ($this->router->fetch_method()) {

			case 'guardar': // <<<---------

				$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
				$this->form_validation->set_rules('direccion', 'Dirección', 'trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('tel_movil', 'Tel movil', 'trim|numeric');
				$this->form_validation->set_rules('tel_fijo', 'Tel fijo', 'trim|numeric');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('sumar', 'Sumar', 'trim|greater_than_equal_to[0]');
				$this->form_validation->set_rules('restar', 'Restar', 'trim|greater_than_equal_to[0]');

				if (!($this->form_validation->run())) {
					throw new Exception(validation_errors());
				}

				$this->elemento = array(
					'nombre' => $this->input->post("nombre", TRUE),
					'direccion' => $this->input->post("direccion", TRUE),
					'tel_movil' => $this->input->post("tel_movil", TRUE),
					'tel_fijo' => $this->input->post("tel_fijo", TRUE),
					'email' => $this->input->post("email", TRUE),
					'saldo' => $this->input->post("sumar", TRUE) - $this->input->post("restar", TRUE),
				);

				break;

			case 'actualizar': // <<<---------

				$this->form_validation->set_rules('id_cuenta', 'id_cuenta', 'trim|greater_than_equal_to[0]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
				$this->form_validation->set_rules('direccion', 'Dirección', 'trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('tel_movil', 'Tel movil', 'trim|numeric');
				$this->form_validation->set_rules('tel_fijo', 'Tel fijo', 'trim|numeric');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('sumar', 'Sumar', 'trim|greater_than_equal_to[0]');
				$this->form_validation->set_rules('restar', 'Restar', 'trim|greater_than_equal_to[0]');

				if (!($this->form_validation->run())) {
					throw new Exception(validation_errors());
				}

				$this->elemento = array(
					'id_cuenta' => $this->input->post("id_cuenta", TRUE),
					'nombre' => $this->input->post("nombre", TRUE),
					'direccion' => $this->input->post("direccion", TRUE),
					'tel_movil' => $this->input->post("tel_movil", TRUE),
					'tel_fijo' => $this->input->post("tel_fijo", TRUE),
					'email' => $this->input->post("email", TRUE),
					'saldo' => $this->input->post("sumar", TRUE) - $this->input->post("restar", TRUE),
				);

				break;

			case 'eliminar': // <<<---------

				$this->form_validation->set_rules('id_cuenta', 'id_cuenta', 'trim|greater_than[0]|required');

				if (!($this->form_validation->run())) {
					throw new Exception(validation_errors());
				}

				$this->id_elemento = $this->input->post("id_cuenta", TRUE);

				break;
			default:

				break;
			}

		} catch (Exception $e) {

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);
			exit();

		}

	}

	public function index()
	{
			
			$this->load->model('producto_model');
			$data["productos"] = $this->producto_model->get_lista_elementos_completa();
			
			$this->load->view("header.php", $this->session->set_flashdata('side_bar','productos'));
			$this->load->view("productos.php", $data);
			$this->load->view("footer.php");

	}


	public function abm() {

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules("id_producto", "id_producto",
			"required|trim|greater_than_equal_to[0]");

		$this->id_elemento=($this->form_validation->run())? $this->input->get("id_producto", TRUE):null;

		try {
			$data[$this->nombre_singular] = $this->model->get_elemento($this->id_elemento);
		}catch(Exception $e){
			echo $e->getMessage();
			exit();
		}

		$this->load->view("header.php");
		$this->load->view($this->vista_abm, $data);
		$this->load->view("footer.php");
	}
}

