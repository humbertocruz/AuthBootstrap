<?php
App::uses('Model', 'Model');

class AbPermissao extends AbAppModel {

	public $useTable = 'permissoes'; // Verificar porque o infrector BR não está funcionando
	
	public $hasMany = array(
		'AbGruposLinksPermissao' => array(
			'className' => 'Ab.AbGruposLinksPermissao',
			'foreignKey' => 'permissao_id'
		),
	);
	
}