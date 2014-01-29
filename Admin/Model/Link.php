<?php
App::uses('Model', 'Model');

class Link extends AdminAppModel {

	public $useTable = 'links';

	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'Admin.GruposLinksPermissao',
			'foreignKey' => 'link_id'
		)
	);

	public $belongsTo = array(
		'Menu' => array(
			'className' => 'Admin.Menu',
			'foreignKey' => 'menu_id'
		)
	);
}