<?php
/**
 * Usuarios
 * Alteração: 09/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * data - variável gerada pelos métodos e enviada a view
 */

class AuthController extends AuthBootstrapAppController {

	public function authenticate() {

		if ($this->request->is('post')) {
			$timestamp = Security::hash( intval( time()/10 ), 'md5', true);
			$data = json_decode( urldecode( $this->data['json'] ), true );

			
			$hashts = $data['hashts'];

			if ($timestamp == $hashts) {
				$usuario = $data['usuario'];
				$menus = $data['menus'];
				$this->Session->write('menus',$menus);
				$this->Auth->login($usuario);
			} else {
				$this->Session->setFlash(__('Tentativa de invasão do sistema.'));
			}
		} else {
			if ( !$this->Auth->LoggedIn() ) {
				//echo Configure::read('login_url');
				$this->redirect(Configure::read('login_url'));
			}

		}
		//$this->redirect('/');
	}
}
