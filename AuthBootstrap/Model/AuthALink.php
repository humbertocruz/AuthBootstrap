<?php
App::uses('Model', 'Model');

class AuthALink extends AuthAdminAppModel {

	public $useTable = 'links';

	public $hasMany = array(
		'AuthAGruposLinksPermissao' => array(
			'className' => 'AuthAdmin.AuthAGruposLinksPermissao'
		)
	);

	public $belongsTo = array(
		'AuthAMenu' => array(
			'className' => 'AuthAdmin.AuthAMenu'
		)
	);
}