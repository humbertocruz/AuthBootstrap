<?php
App::uses('Model', 'Model');

class Usuario extends AuthLoginAppModel {
	
	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'AuthLogin.GruposUsuario'
		),
		'Login' => array(
			'className' => 'AuthLogin.Login'
		),
	);
	
}