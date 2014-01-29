<?php
App::uses('Model', 'Model');

class Permissao extends AdminAppModel {

	public $useTable = 'permissoes'; // Verificar porque o infrector BR não está funcionando
	
	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'Admin.GruposLinksPermissao',
			'foreignKey' => 'permissao_id'
		),
	);
	
}