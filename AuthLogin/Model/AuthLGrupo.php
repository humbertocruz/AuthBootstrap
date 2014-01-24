<?php
App::uses('Model', 'Model');

class AuthLGrupo extends AuthLoginAppModel {

	public $useTable = 'grupos';
	
	public $hasMany = array(
		'AuthLGruposUsuario' => array(
			'className' => 'AuthLogin.AuthLGruposUsuario'
		),
	);
}