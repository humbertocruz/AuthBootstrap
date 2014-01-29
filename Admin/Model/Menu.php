<?php
App::uses('Model', 'Model');

class Menu extends AdminAppModel {

	public $useTable = 'menus';

	public $hasMany = array(
		'Link' => array(
			'className' => 'Admin.Link',
			'foreignKey' => 'menu_id'
		)
	);
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'Admin.Grupo',
			'foreignKey' => 'grupo_id'
		)
	);
}