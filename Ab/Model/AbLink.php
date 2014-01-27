<?php
App::uses('Model', 'Model');

class AbLink extends AbAppModel {

	public $useTable = 'links';

	public $hasMany = array(
		'AbGruposLinksPermissao' => array(
			'className' => 'Ab.AbGruposLinksPermissao',
			'foreignKey' => 'link_id'
		)
	);

	public $belongsTo = array(
		'AbMenu' => array(
			'className' => 'Ab.AbMenu',
			'foreignKey' => 'menu_id'
		)
	);
}