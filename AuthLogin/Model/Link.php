<?php
App::uses('Model', 'Model');

class Link extends AuthLoginAppModel {
	public $hasMany = array(
		'GruposLinksPermissoes' => array(
			'className' => 'AuthLogin.GruposLinksPermissoes'
		),
	);
}