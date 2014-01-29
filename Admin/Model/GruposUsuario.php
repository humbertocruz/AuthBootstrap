<?php
App::uses('Model', 'Model');

class GruposUsuario extends AdminAppModel {

	public $useTable = 'grupos_usuarios';
	
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'Admin.Grupo',
			'foreignKey' => 'grupo_id'
		),
		'Usuario' => array(
			'className' => 'Admin.Usuario',
			'foreignKey' => 'usuario_id'
		)
	);
}