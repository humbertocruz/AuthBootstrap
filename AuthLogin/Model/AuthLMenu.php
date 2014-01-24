<?php
App::uses('Model', 'Model');

class AuthLMenu extends AuthLoginAppModel {

	public $useTable = 'menus';

	public $hasMany = array(
		'AuthLLink' => array(
			'className' => 'AuthLogin.AuthLLink'
		),
	);
}