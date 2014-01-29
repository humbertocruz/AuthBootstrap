<?php
class AuthenAppController extends AppController {

	public $layout = 'bootstrap';
	public $helpers = array(
		'Session',
		'Bootstrap.AuthBs'
	);
	public $components = array(
		'Session',
		'Auth'=>array(
			'loginAction' => array(
				'plugin' => 'Auth',
				'controller' => 'Authenticator',
				'action' => 'authenticate'
			),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Authen.Usuario',
					'fields' => array(
						'username' => 'usuario',
						'password' => 'senha'
					)
				)
			)
		)
	);

	public function beforeRender() {
		//Lista dos sistemas para o Menu deste Sistema
		/*
		$SistemasMenu = $this->Sistema->find( 'list', array( 'fields'=>array( 'id', 'nome' ) ) );
		$SistemasMenu = array( 0=>'Selecione o Sistema' ) + $SistemasMenu;
		$this->set( 'SistemasMenu', $SistemasMenu );
		*/
		
	}
	
	public function beforeFilter() {
		$this->layout = 'Bootstrap.bootstrap-admin'; //Layout para o Admin
	}
}

	