<?PHP

public function GenericoForm()
{
	//*************************************
	//CHEQUEO QUE EL USUARIO ESTE LOGGEADO
	//*************************************
	if(isset($this->session->logged_in)){

		//****************************	
		//VALIDO LOS CAMPOS FORMULARIO
		//****************************
		$this->load->library('form_validation');
		$this->form_validation->set_rules('campo', 'Campo', 'trim|required');

		if ($this->form_validation->run())
		{

			//***********************************************************
			//SI LLEGO A ESTE PUNTO SIGNIFICA QUE TODOS LOS CONTROLES
			// SALIERON BIEN, SE PROCEDE A EJECUTAR LA LOGIGA DE NEGOCIO
			//***********************************************************

			//*****************
			//RECIBO EL POST
			//*****************
			$campo = $this->input->post('campo');


			//****************************
			//GUARDO EN LA BASE DE DATOS
			//****************************
			try {

				$this->load->model('model');
				$n_pedido = $this->model->funcion('datos1', 'dato 2');

			}catch (Exception $e) {

				echo "Error al ingresar su pedido a la base de datos. 
				/n Por favor intentelo mas tade o comuniquese con el area de desarrollo, INT: 5843";
				$e->getMessage();

			}

			//*************
			//GENERO EL PDF
			//*************

			// Se carga la libreria fpdf
			$this->load->library('Pdf');
			// Se llama a la funcion que genera el pdf correspondiente
			$this->pdf->CrearAula($campos);


			//***************
			//ENVIO EL MAIL
			//***************

			// Configuro la timezone y cargo la libreria para mandar mails
			date_default_timezone_set('America/Argentina/Buenos_Aires');

			$this->load->library('email');

			$asunto = $dependencia ." -- ". $subdependencia . " -- ID: MS". $n_pedido;

			$cuerpo = "cuerpo" .

			/*pie del correo (remitente)*/
			PHP_EOL.PHP_EOL.PHP_EOL.
			"Remitente: ". $_SESSION['nombre'] . " " . $_SESSION['apellido'] .
			"int: " . $_SESSION['interno']; 

			$this->email->from(/*email remitente*/'gestion_campus@unla.edu.ar', /*nombre del remitente*/ 'Gestión Campus');
			$this->email->to(/*destinatario*/'desarrollo-campus@unla.edu.ar');
			$this->email->reply_to($_SESSION['email']);

			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');

			//Escribo el mail en cuestion
			$this->email->subject(/*asunto*/ $asunto);
			$this->email->message(/*cuerpo del mensaje*/ $cuerpo);

			//Envia el correo
			$this->email->send();

			//**************************************************
			//REDIRECCIONO A LOS AGRADECIMIENTOS PERSONALIZADOS
			//**************************************************
			redirect('/MODULO/gracias', 'refresh');

		}else
		{
			echo validation_errors();
			echo "Error: Revise los campos del formulario";
		}
	}else
	{
		echo "Error: El usuario no ingreso al sistema";
	}
}