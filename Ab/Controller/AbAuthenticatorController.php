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

class AbAuthenticatorController extends AbAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('authenticate');
	}

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
				$this->Session->setFlash(__('Login efetuado com sucesso.'));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('Tentativa de invasão do sistema.'));
			}
		} else {
			$this->redirect(Configure::read('menus_url').'?sistema_id='.Configure::read('sistema_id'));
		}
		
	}
}
