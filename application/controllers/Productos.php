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

				break;

			case 'actualizar': // <<<---------

				break;

			case 'eliminar': // <<<---------

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

		if (isset($this->id_elemento)){

			try {

				$data[$this->nombre_singular] = $this->model->get_elemento($this->id_elemento);

				$this->load->view("header.php");
				$this->load->view($this->vista_abm, $data);
				$this->load->view("footer.php");

			}catch(Exception $e){
				echo $e->getMessage();
				exit();
			}

		}else{
			$this->load->view("header.php");
			$this->load->view($this->vista_abm);
			$this->load->view("footer.php");
		}

	}


	public function guardar(){
		var_dump($_POST);

		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|alpha_numeric_spaces|required');
		$this->form_validation->set_rules('categorias[]',"Categorias", "trim|greater_than_equal_to[0]");
		$this->form_validation->set_rules('marca', 'Marca', 'trim|greater_than_equal_to[0]');
		$this->form_validation->set_rules('ean-13', 'Codigo de Barras', 'trim|exact_length[13]|numeric');
		$this->form_validation->set_rules('precio_venta', 'Precio', 'trim|greater_than_equal_to[0]|required');
		$this->form_validation->set_rules('unidad', 'Unidad', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('minimo', 'Mínimo', 'trim|greater_than_equal_to[0]');
		if (!empty($_POST['usa_stock'])) {
			$this->form_validation->set_rules('sumar', 'Sumar', 'trim|greater_than_equal_to[0]');
			$this->form_validation->set_rules('restar', 'Restar', 'trim|greater_than_equal_to[0]');
		}
	}




	public function buscar_elemento_ajax() {
		$this->form_validation->set_rules('texto_busqueda','Busqueda','alpha_numeric_spaces|required');
		if (!($this->form_validation->run())) {
			$texto_busqueda = "";
		}else{
			$texto_busqueda = $_POST["texto_busqueda"];
		}
		try{
			$resultado = $this->model->buscar_elemento($texto_busqueda);
		}catch (Exception $e) {
			$resultado = [];
		}
		echo json_encode($resultado);
	}
}

