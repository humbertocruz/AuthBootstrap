<?php
App::uses('Model', 'Model');

class AbGruposUsuario extends AbAppModel {

	public $useTable = 'grupos_usuarios';
	
	public $belongsTo = array(
		'AbGrupo' => array(
			'className' => 'Ab.AbGrupo',
			'foreignKey' => 'grupo_id'
		),
		'AbUsuario' => array(
			'className' => 'Ab.AbUsuario',
			'foreignKey' => 'usuario_id'
		)
	);
}