<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends Member_Controller {

	var $nombre_plural;
	var $nombre_singular;
	var $vista_listado;
	var $vista_abm;
	var $elemento;
	var $id_elemento;

	public function __construct() {
		parent::__construct();

		$this->load->model('cliente_model', 'model');

		$this->nombre_plural = "clientes";
		$this->nombre_singular = "cliente";
		$this->vista_listado = "clientes.php";
		$this->vista_abm = "abm_cliente.php";

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

			case 'abm': // <<<---------

				$this->form_validation->set_data($_GET);
				$this->form_validation->set_rules("id_cuenta", "id_cuenta",
					"required|trim|greater_than_equal_to[0]");

				$this->id_elemento = ($this->form_validation->run()) ? $this->input->get("id_cuenta", TRUE) : null;

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

	public function index() {

		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules('pagina_actual', 'Pagina actual', 'required|trim|greater_than[0]');

		$pagina_actual = ($this->form_validation->run() == FALSE) ? 1 : $this->input->get('pagina_actual', TRUE);

		$elementos_por_pagina = 10;

		$cantidad_paginas_totales = $this->model->cantidad_paginas($elementos_por_pagina);

		$data[$this->nombre_plural] = $this->model->get_lista_elementos_pagina(
			$pagina_actual,
			$elementos_por_pagina
		);

		$data["paginador"] = $this->load->view(
			"paginador.php",
			array(
				"link" => $this->nombre_plural,
				"pagina_actual" => $pagina_actual,
				"cantidad_paginas_totales" => $cantidad_paginas_totales,
				"rango" => calcular_rango_paginador(
					$pagina_actual, $cantidad_paginas_totales, 7),
			),
			TRUE
		);

		$this->load->view("header.php", $this->session->set_flashdata('side_bar', $this->nombre_plural));
		$this->load->view($this->vista_listado, $data);
		$this->load->view("footer.php");

	}

	public function abm() {

		if (isset($this->id_elemento)) {
			try {

				$data[$this->nombre_singular] = $this->model->get_elemento($this->id_elemento);

				$this->load->view("header.php");
				$this->load->view($this->vista_abm, $data);
				$this->load->view("footer.php");

			} catch (Exception $e) {
				echo $e->getMessage();
				exit();
			}

		} else {
			$this->load->view("header.php");
			$this->load->view($this->vista_abm);
			$this->load->view("footer.php");
		}
	}

	public function guardar() {

		try {

			$this->model->guardar_elemento($this->elemento);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		} catch (Exception $e) {

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);

		}
	}

	public function actualizar() {

		try {

			$this->model->actualizar_elemento($this->elemento);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		} catch (Exception $e) {

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();
			echo json_encode($respuesta);

		}

	}

	public function eliminar() {

		try {

			$this->model->eliminar_elemento($this->id_elemento);

			$respuesta["estado"] = "ok";
			echo json_encode($respuesta);

		} catch (Exception $e) {

			$respuesta["estado"] = "error";
			$respuesta["mensaje"] = $e->getMessage();

			echo json_encode($respuesta);
		}

	}

	public function buscar_elemento() {

		$texto_busqueda = (isset($_POST["texto_busqueda"])) ? $this->input->post("texto_busqueda", TRUE) : "";

		if ($texto_busqueda != "") {

			try {

				$resultado = $this->model->buscar_elemento($texto_busqueda);
				$data[$this->nombre_plural] = $resultado;
				$data["texto_busqueda"] = $texto_busqueda;

			} catch (Exception $e) {
				$data[$this->nombre_plural] = NULL;
				$data["texto_busqueda"] = NULL;
			}

			$this->load->view("header.php", $this->session->set_flashdata('side_bar', $this->nombre_plural));
			$this->load->view($this->vista_listado, $data);
			$this->load->view("footer.php");

		} else {

			$this->index();

		}

	}

}
