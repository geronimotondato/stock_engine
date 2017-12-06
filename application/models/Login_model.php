<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	// ******************************************************************************
	// ► Func : crear un nuevo usuario en la base de datos
	// ► Obser: 
	// ► ToDo : 
	// ******************************************************************************
	public function create_user($username,$nombre,$apellido,$password)
	{
		$opciones = [
			'cost' => 11
		];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $opciones);
		$data = [
			'username'  => $username,
			'nombre'	=> $nombre,
			'apellido'	=> $apellido,
			'password'  => $hashedPassword,
		];

		if ($this->db->insert('usuario', $data)){
			return true;
		} else {
			return false;
		}
	}

	// ******************************************************************************
	// ► Func : consulta a la base de datos por un usuario
	// ► Obser: devuelve toda el registro del usuario
	// ► ToDo :
	// ******************************************************************************
	public function get_user($username)
	{
		$query = $this->db->get_where('usuario',array('username' => $username))->row_array();
		if(empty($query)){
			throw new Exception("El usuario no existe");
		}
		return $query;  
	}
}