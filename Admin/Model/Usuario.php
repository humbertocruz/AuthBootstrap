<?php
App::uses('Model', 'AppModel');

class Usuario extends AdminAppModel {

	public $useTable = 'usuarios';

	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'Admin.GruposUsuario',
			'foreignKey' => 'usuario_id'
		),
		'Login' => array(
			'className' => 'Admin.Login',
			'foreignKey' => 'usuario_id'
		),
	);
	
}