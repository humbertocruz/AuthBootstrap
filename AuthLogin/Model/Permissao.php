<?php
App::uses('Model', 'Model');

class Permissao extends AuthLoginAppModel {
	public $useTable = 'permissoes';
	
	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'AuthLogin.GruposLinksPermissoes'
		),
	);
	
}