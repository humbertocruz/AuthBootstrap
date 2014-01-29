<?php
App::uses('Model', 'Model');

class Sistema extends ServerAppModel {

	public $useTable = 'sistemas';

	public $hasMany = array(
		'Grupo' => array(
			'className'=>'Server.Grupo',
			'foreignKey' => 'sistema_id'
		)
	);		
}