<?php
App::uses('Model', 'Model');

class Login extends AdminAppModel {

	public $useTable = 'logins';

	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Admin.Usuario',
			'foreignKey' => 'usuario_id'
		)
	);

}