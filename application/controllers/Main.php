<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Member_Controller {

	public function index()
	{

		
		$this->load->model('orden_model');

		$this->load->library('form_validation');
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
}

