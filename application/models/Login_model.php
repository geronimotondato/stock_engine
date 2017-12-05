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
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$opciones = [
			'cost' => 11,
			'salt' => $salt,
		];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $opciones);
		$data = [
			'username'  => $username,
			'nombre'		=> $nombre,
			'apellido'	=> $apellido,
			'password'  => $hashedPassword,
			'salt'      => $salt,
		];

		if ($this->db->insert('usuario', $data)){
			return true;
		} else {
			return false;
		}
	}

	// ******************************************************************************
	// ► Func : Encripta un password con una variable salt proporcionada
	// ► Obser: aplica la funcion password_hash de PHP
	// ► ToDo : 
	// ******************************************************************************
	public function encrypt_password($password,$salt)
	{
		$opciones = [
		'cost' => 11,
		'salt' => $salt,
		];
		return password_hash($password, PASSWORD_BCRYPT, $opciones);
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