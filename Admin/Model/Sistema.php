<?php
App::uses('Model', 'Model');

class Sistema extends AdminAppModel {

	public $useTable = 'sistemas';
	
	public $hasMany = array(
		'Grupo' => array(
			'className' => 'Admin.Grupo',
			'foreignKey' => 'sistema_id'
		),
	);
	
}