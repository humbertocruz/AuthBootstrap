<?php
App::uses('Model', 'Model');

class Menu extends AuthAdminAppModel {
	public $hasMany = array(
		'Link' => array(
			'className' => 'AuthAdmin.Link'
		)
	);
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'AuthAdmin.Grupo'
		)
	);
}