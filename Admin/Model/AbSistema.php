<?php
App::uses('Model', 'Model');

class AbSistema extends AbAppModel {

	public $useTable = 'sistemas';
	
	public $hasMany = array(
		'AbGrupo' => array(
			'className' => 'Ab.AbGrupo',
			'foreignKey' => 'sistema_id'
		),
	);
	
}