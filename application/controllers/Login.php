<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function log_in()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user', 'Usuario', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('pass', 'Contraseña', 'trim|required');
		try{
			if(!($this->form_validation->run())){
				throw new Exception("Los input no pasan la validacion");
			}
			$usuario  = $this->input->post('user', TRUE);
			$password = $this->input->post('pass', TRUE);
			$this->load->model('login_model');
			$user = $this->login_model->get_user($usuario);
			//compruebo que el password de la BD sea igual al proporcionado por el usuario
			if(!password_verify( $password , $user["password"] )){
				throw new Exception('Usuario o contraseña incorrectos');
			}
			$newdata = [
				'username'  => $user["username"],
				'nombre'    => $user["nombre"],
				'apellido'  => $user["apellido"],
				'logged_in' => TRUE
			];
			$this->session->set_userdata($newdata);
			redirect('/', 'refresh');
		}catch(Exception $e){
			$this->session->set_flashdata('mensaje', 'Usuario o contraseña incorrectos');
			redirect('/', 'refresh');
		}
		
	}

	public function log_out()
	{
		$userdata = ['username', 'nombre', 'apellido', 'logged_in'];
		$this->session->unset_userdata($userdata);
		redirect('/', 'refresh');
	}

	public function create_user()
	{
		try {
			$pass     = $this->input->get('pass'	, TRUE);
			$username = $this->input->get('username', TRUE);
			$nombre   = $this->input->get('nombre'	, TRUE);
			$apellido = $this->input->get('apellido', TRUE);
			$password = $this->input->get('password', TRUE);

			//Valido que el usuario este loggeado en el sistema
			if(! isset($this->session->logged_in)) throw new Exception('debe ingresar al sistema para poder crear usuarios');

			//Valido que la contraseña para crear usuarios sea correcta
			if(! ($pass === "grandstream") ) throw new Exception('el password proporcionado es incorrecto');


			$this->load->model('login_model');

			if ($this->login_model->create_user($username,$nombre,$apellido,$password)){
				echo "usuario creado con exito";
			} else {
				echo "error al crear usuario";
			}

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}