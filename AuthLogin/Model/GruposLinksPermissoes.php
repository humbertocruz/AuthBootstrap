<?php
App::uses('Model', 'Model');

class GruposLinksPermissoes extends AuthLoginAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'Permissao' => array(
			'className' => 'AuthLogin.Permissao'
		),
	);
}