<?php
App::uses('Model', 'Model');

class AuthASistema extends AuthAdminAppModel {

	public $useTable = 'sistemas';
	
	public $hasMany = array(
		'AuthAGrupo' => array(
			'className' => 'AuthAdmin.AuthAGrupo'
		),
	);
	
}