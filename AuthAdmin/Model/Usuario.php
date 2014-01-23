<?php
App::uses('Model', 'Model');

class Usuario extends AuthAdminAppModel {
	
	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'AuthAdmin.GruposUsuario'
		),
		'Login' => array(
			'className' => 'AuthAdmin.Login'
		),
	);
}