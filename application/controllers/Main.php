<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Member_Controller {

	public function index()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_data($_GET);
		$this->form_validation->set_rules(
			'numero_pagina', 
			'Numero de pagina',
			'required|trim|greater_than[0]'
		);

		if($this->form_validation->run() == FALSE){
			$numero_pagina = 1;
		}else{
			$numero_pagina = $this->input->get('numero_pagina', TRUE);
		}
		$elementos_por_pagina = 10;
		$this->load->model('orden_model');
		
		$data["ordenes"] = $this->orden_model->get_lista_ordenes_pagina($numero_pagina, $elementos_por_pagina);

		$p["seccion"] = "";
		$p["numero_pagina"]    = $numero_pagina;
		$p["cantidad_paginas"] = ceil($this->orden_model->cantidad_ordenes()/$elementos_por_pagina);
		$p["rango"]            = calcular_rango_paginador(
									$p["numero_pagina"],
									$p["cantidad_paginas"],
									7
								 );	

		$data["paginador"] = $this->load->view("paginador.php", $p, TRUE);

		$this->load->view("header.php", $this->session->set_flashdata('side_bar','ordenes'));
		$this->load->view("ordenes.php", $data);
		$this->load->view("footer.php");

	}
}

