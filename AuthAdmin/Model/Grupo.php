<?php
App::uses('Model', 'Model');

class Grupo extends AuthAdminAppModel {
	
	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'AuthAdmin.GruposUsuario'
		),
		'GruposLinksPermissao' => array(
			'className' => 'AuthAdmin.GruposLinksPermissao'
		)
	);

	public $belongsTo = array(
		'Sistema' => array(
			'className'=> 'AuthAdmin.Sistema'
		)
	);
}