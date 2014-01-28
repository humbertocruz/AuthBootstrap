<?php
App::uses('Model', 'Model');

class AbLogin extends AbAppModel {

	public $useTable = 'logins';

	public $belongsTo = array(

		'AbUsuario' => array(
			'className' => 'Ab.AbUsuario',
			'foreignKey' => 'usuario_id'
		)
	);

}