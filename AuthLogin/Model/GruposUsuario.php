<?php
App::uses('Model', 'Model');

class GruposUsuario extends AuthLoginAppModel {
	
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'AuthLogin.Grupo'
		),
		'Usuario' => array(
			'className' => 'AuthLogin.Usuario'
		)
	);
}