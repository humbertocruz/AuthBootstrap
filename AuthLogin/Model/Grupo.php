<?php
App::uses('Model', 'Model');

class Grupo extends AuthLoginAppModel {
	
	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'AuthLogin.GruposUsuario'
		),
	);
}