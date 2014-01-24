<?php
App::uses('Model', 'Model');

class AuthLLink extends AuthLoginAppModel {

	public $useTable = 'links';

	public $hasMany = array(
		'AuthLGruposLinksPermissoes' => array(
			'className' => 'AuthLogin.AuthLGruposLinksPermissoes'
		),
	);
}