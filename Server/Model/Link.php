<?php
App::uses('Model', 'Model');

class Link extends ServerAppModel {

	public $useTable = 'links';

	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'Server.GruposLinksPermissao',
			'foreignKey' => 'link_id'
		)
	);
	
}
