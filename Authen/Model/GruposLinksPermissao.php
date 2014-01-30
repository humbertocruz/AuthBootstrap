<?php
App::uses('Model', 'Model');

class GruposLinksPermissao extends AuthenAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'Permissao' => array(
			'className' => 'Authen.Permissao',
			'foreignKey' => 'permissao_id'
		),
		'Grupo' => array(
			'className' => 'Authen.Grupo',
			'foreignKey' => 'grupo_id'
		),
		'Link' => array(
			'className' => 'Authen.Link',
			'foreignKey' => 'link_id'
		),
	);

}