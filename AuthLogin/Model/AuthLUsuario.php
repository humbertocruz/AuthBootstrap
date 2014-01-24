<?php
App::uses('Model', 'Model');

class AuthLUsuario extends AuthLoginAppModel {

	public $useTable = 'usuarios';
	
	public $hasMany = array(
		'AuthLGruposUsuario' => array(
			'className' => 'AuthLogin.AuthLGruposUsuario'
		),
		'AuthLLogin' => array(
			'className' => 'AuthLogin.AuthLLogin'
		),
	);
	
}