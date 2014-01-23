<?php
App::uses('Model', 'Model');

class Permissao extends AuthAdminAppModel {
	public $useTable = 'permissoes'; // Verificar porque o infrector BR não está funcionando
	
	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'AuthAdmin.GruposLinksPermissao'
		),
	);
	
}