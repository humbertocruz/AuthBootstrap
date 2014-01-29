<?php
App::uses('Model', 'Model');

class Usuario extends ServerAppModel {

	public $useTable = 'usuarios';

	public $hasMany = array(
		'Login' => array(
			'className' => 'Server.Login',
			'foreignKey' => 'usuario_id'
		)
	);

		
}