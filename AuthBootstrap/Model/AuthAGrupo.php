<?php
App::uses('Model', 'Model');

class AuthAGrupo extends AuthAdminAppModel {

	public $useTable = 'grupos';
	
	public $hasMany = array(
		'AuthAGruposUsuario' => array(
			'className' => 'AuthAdmin.AuthAGruposUsuario'
		),
		'AuthAGruposLinksPermissao' => array(
			'className' => 'AuthAdmin.AuthAGruposLinksPermissao'
		)
	);

	public $belongsTo = array(
		'AuthASistema' => array(
			'className'=> 'AuthAdmin.AuthASistema'
		)
	);
}