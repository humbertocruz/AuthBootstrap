<?php
App::uses('Model', 'Model');

class Permissao extends ServerAppModel {

	public $useTable = 'permissoes';

	public $hasMany = array(
		'GruposLinksPermissao' => array(
			'className' => 'Server.GruposLinksPermissao',
			'foreignKey' => 'permissao_id'
		)
	);
}
