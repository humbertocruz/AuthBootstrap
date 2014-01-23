<?php
App::uses('Model', 'Model');

class GruposUsuario extends AuthAdminAppModel {
	
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'AuthAdmin.Grupo'
		),
		'Usuario' => array(
			'className' => 'AuthAdmin.Usuario'
		)
	);
}