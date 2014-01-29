<?php
App::uses('Model', 'Model');

class GruposLinksPermissao extends AdminAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'Permissao' => array(
			'className' => 'Admin.Permissao',
			'foreignKey' => 'permissao_id'
		),
		'Grupo' => array(
			'className' => 'Admin.Grupo',
			'foreignKey' => 'grupo_id'
		),
		'Link' => array(
			'className' => 'Admin.Link',
			'foreignKey' => 'link_id'
		),
	);

}