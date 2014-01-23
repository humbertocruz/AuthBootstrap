<?php
App::uses('Model', 'Model');

class Menu extends AuthLoginAppModel {
	public $hasMany = array(
		'Link' => array(
			'className' => 'AuthLogin.Link'
		),
	);
}