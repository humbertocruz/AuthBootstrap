<?php
App::uses('Model', 'Model');

class AuthLSistema extends AuthLoginAppModel {

	public $useTable = 'sistemas';
	
	public $hasMany = array(
		'AuthLGrupo' => array(
			'className' => 'AuthLogin.AuthLGrupo'
		),
	);
	
}