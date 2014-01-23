<?php
App::uses('Model', 'Model');

class Sistema extends AuthAdminAppModel {
	
	public $hasMany = array(
		'Grupo' => array(
			'className' => 'AuthAdmin.Grupo'
		),
	);
	
}