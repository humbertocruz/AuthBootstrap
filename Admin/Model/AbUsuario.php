<?php
App::uses('Model', 'AppModel');

class AbUsuario extends AbAppModel {

	public $useTable = 'usuarios';

	public $hasMany = array(
		'AbGruposUsuario' => array(
			'className' => 'Ab.AbGruposUsuario',
			'foreignKey' => 'usuario_id'
		),
		'AbLogin' => array(
			'className' => 'Ab.AbLogin',
			'foreignKey' => 'usuario_id'
		),
	);
	
}