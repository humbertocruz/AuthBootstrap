<?php
App::uses('Model', 'Model');

class AbGrupo extends AbAppModel {

	public $useTable = 'grupos';
	
	public $hasMany = array(
		'AbGruposUsuario' => array(
			'className' => 'Ab.AbGruposUsuario',
			'foreignKey' => 'grupo_id'
		),
		'AbGruposLinksPermissao' => array(
			'className' => 'Ab.AbGruposLinksPermissao',
			'foreignKey' => 'grupo_id'
		)
	);

	public $belongsTo = array(
		'AbSistema' => array(
			'className'=> 'Ab.AbSistema',
			'foreignKey' => 'sistema_id'
		)
	);
}