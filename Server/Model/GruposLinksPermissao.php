<?php
App::uses('Model', 'Model');

class GruposLinksPermissao extends ServerAppModel {

	public $useTable = 'grupos_links_permissoes';

	public $belongsTo = array(
		'Permissao' => array(
			'className' => 'Server.Permissao',
			'foreignKey' => 'permissao_id'
		)
	);
}
