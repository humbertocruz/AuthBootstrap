<?php
App::uses('Model', 'Model');

class AuthAUsuario extends AuthAdminAppModel {

	public $useTable = 'usuarios';
	
	public $hasMany = array(
		'AuthAGruposUsuario' => array(
			'className' => 'AuthAdmin.AuthAGruposUsuario'
		),
		'AuthALogin' => array(
			'className' => 'AuthAdmin.AuthALogin'
		),
	);
}