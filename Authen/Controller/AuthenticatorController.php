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

class AuthenticatorController extends AuthenAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('authenticate');
	}

	public function authenticate() {
		$json = $this->request->data;
		$data = json_decode(urldecode($json), true);  //Parser da resposta Json
		$timest = Security::hash( intval( time()/10 ), 'md5', true);
		$hashts = $data['hashts'];
			
		if ($timest == $hashts) {
			$usuario = $data['usuario'];
			$menus = $data['menus'];
			if (empty($usuario)) {
			} else {
				$this->Session->write('menus',$menus);
				$this->Auth->login($usuario);
				$this->Session->setFlash(__('Login efetuado com sucesso.'));
				//$this->redirect('/');	
			}			
		} else {
			//$this->Session->setFlash(__('Tentativa de invasão do sistema.'));
		}		
	}
}
