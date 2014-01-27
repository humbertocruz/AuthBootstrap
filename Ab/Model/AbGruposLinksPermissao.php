<?php
App::uses('Model', 'Model');

class AbGruposLinksPermissao extends AbAppModel {

	public $useTable = 'grupos_links_permissoes';
	
	public $belongsTo = array(
		'AbPermissao' => array(
			'className' => 'Ab.AbPermissao',
			'foreignKey' => 'permissao_id'
		),
		'AbGrupo' => array(
			'className' => 'Ab.AbGrupo',
			'foreignKey' => 'grupo_id'
		),
		'AbLink' => array(
			'className' => 'Ab.AbLink',
			'foreignKey' => 'link_id'
		),
	);

}