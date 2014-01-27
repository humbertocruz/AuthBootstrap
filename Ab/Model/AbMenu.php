<?php
App::uses('Model', 'Model');

class AbMenu extends AbAppModel {

	public $useTable = 'menus';

	public $hasMany = array(
		'AbLink' => array(
			'className' => 'Ab.AbLink',
			'foreignKey' => 'menu_id'
		)
	);
	public $belongsTo = array(
		'AbGrupo' => array(
			'className' => 'Ab.AbGrupo',
			'foreignKey' => 'grupo_id'
		)
	);
}