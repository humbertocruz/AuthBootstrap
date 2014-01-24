<?php
App::uses('Model', 'Model');

class AuthLGruposLinksPermissoes extends AuthLoginAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'AuthLPermissao' => array(
			'className' => 'AuthLogin.AuthLPermissao'
		),
	);
}