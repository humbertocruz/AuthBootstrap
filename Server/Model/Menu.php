<?php
App::uses('Model', 'Model');

class Menu extends ServerAppModel {

	public $useTable = 'menus';

	public $hasMany = array(
		'Link' => array(
			'className' => 'Server.Link',
			'foreignKey' => 'menu_id'
		)
	);
}
