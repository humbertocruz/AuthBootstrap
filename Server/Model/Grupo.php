<?php
App::uses('Model', 'Model');

class Grupo extends ServerAppModel {

	public $useTable = 'grupos';

	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'Server.GruposUsuario',
			'foreignKey' => 'grupo_id'
		)
	);

	public $belongsTo = array(
		'Sistema' => array(
			'className' => 'Server.Sistema',
			'foreignKey' => 'sistema_id'
		),
	);
}
