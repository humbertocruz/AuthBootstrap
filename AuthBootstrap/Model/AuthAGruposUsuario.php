<?php
App::uses('Model', 'Model');

class AuthAGruposUsuario extends AuthAdminAppModel {

	public $useTable = 'grupos_usuarios';
	
	public $belongsTo = array(
		'AuthAGrupo' => array(
			'className' => 'AuthAdmin.AuthAGrupo'
		),
		'AuthAUsuario' => array(
			'className' => 'AuthAdmin.AuthAUsuario'
		)
	);
}