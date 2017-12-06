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
				throw new Exception('Combinación Usuario/Password incorrecta');
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
			$this->session->set_flashdata('mensaje', $e->getMessage());
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
		$pass = $this->input->get('pass', TRUE);
		if( $pass === "grandstream" ){
			$this->load->model('login_model');
			$username = $this->input->get('username', TRUE);
			$nombre   = $this->input->get('nombre', TRUE);
			$apellido = $this->input->get('apellido', TRUE);
			$password = $this->input->get('password', TRUE);
			if ($this->login_model->create_user($username,$nombre,$apellido,$password)){
				echo "usuario creado con exito";
			} else {
				echo "error al crear usuario";
			}
		}else{
			echo "el password proporcionado es incorrecto";
		}
	}
	
}