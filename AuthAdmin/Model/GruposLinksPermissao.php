<?php
App::uses('Model', 'Model');

class GruposLinksPermissao extends AuthAdminAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'Permissao' => array(
			'className' => 'AuthAdmin.Permissao'
		),
		'Grupo' => array(
			'className' => 'AuthAdmin.Grupo'
		),
		'Link' => array(
			'className' => 'AuthAdmin.Link'
		),
	);

}