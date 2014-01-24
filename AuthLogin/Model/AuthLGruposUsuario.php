<?php
App::uses('Model', 'Model');

class AuthLGruposUsuario extends AuthLoginAppModel {

	public $useTable = 'grupos_usuarios';
	
	public $belongsTo = array(
		'AuthLGrupo' => array(
			'className' => 'AuthLogin.AuthLGrupo'
		),
		'AuthLUsuario' => array(
			'className' => 'AuthLogin.AuthLUsuario'
		)
	);
}