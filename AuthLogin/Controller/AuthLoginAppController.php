<?php
class AuthLoginAppController extends AppController {

	public $layout = 'AuthBootstrap.bootstrap';

	public $components = array(
		'Session',
		'AuthBootstrap.AuthBs',
		'Auth'=>array(
			'loginAction' => array(
				'controller' => 'auth',
				'action' => 'authenticate'
			),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Usuario',
					'fields' => array(
						'username' => 'usuario',
						'password' => 'senha'
					)
				)
			)
		)
	);

	public function beforeFilter() {

		//$this->Auth->allow('login','logout');

	}
	
}
