<?php
App::uses('Model', 'Model');

class AuthAPermissao extends AuthAdminAppModel {

	public $useTable = 'permissoes'; // Verificar porque o infrector BR não está funcionando
	
	public $hasMany = array(
		'AuthAGruposLinksPermissao' => array(
			'className' => 'AuthAdmin.AuthAGruposLinksPermissao'
		),
	);
	
}