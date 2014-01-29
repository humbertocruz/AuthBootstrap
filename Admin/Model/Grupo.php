<?php
App::uses('Model', 'Model');

class Grupo extends AdminAppModel {

	public $useTable = 'grupos';
	
	public $hasMany = array(
		'GruposUsuario' => array(
			'className' => 'Admin.GruposUsuario',
			'foreignKey' => 'grupo_id'
		),
		'GruposLinksPermissao' => array(
			'className' => 'Admin.GruposLinksPermissao',
			'foreignKey' => 'grupo_id'
		)
	);

	public $belongsTo = array(
		'Sistema' => array(
			'className'=> 'Admin.Sistema',
			'foreignKey' => 'sistema_id'
		)
	);
}