<?php
App::uses('Model', 'Model');

class Sistema extends AuthLoginAppModel {
	
	public $hasMany = array(
		'Grupo' => array(
			'className' => 'AuthLogin.Grupo'
		),
	);
	
}