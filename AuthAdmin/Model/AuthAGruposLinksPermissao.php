<?php
App::uses('Model', 'Model');

class AuthAGruposLinksPermissao extends AuthAdminAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'AuthAPermissao' => array(
			'className' => 'AuthAdmin.AuthAPermissao'
		),
		'AuthAGrupo' => array(
			'className' => 'AuthAdmin.AuthAGrupo'
		),
		'AuthALink' => array(
			'className' => 'AuthAdmin.AuthALink'
		),
	);

}