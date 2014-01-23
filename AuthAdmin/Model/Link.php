<?php
App::uses('Model', 'Model');

class Link extends AuthAdminAppModel {
	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'AuthAdmin.GruposLinksPermissao'
		)
	);

	public $belongsTo = array(
		'Menu' => array(
			'className' => 'AuthAdmin.Menu'
		)
	);
}