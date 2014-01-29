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

		$servidor = Configure::read('menus_url').'?sistema_id=1';
		// Parametros da requisição
		$content = http_build_query(array(
			'sistema_id' => Configure::read('sistema_id')
		));
		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => "Connection: close\r\n".
				'Content-type: application/x-www-form-urlencoded\r\n'.
				'Content-Length: '.strlen($content).'\r\n',
				'content' => $content
			)
		));
		$timestamp = Security::hash( intval( time()/10 ), 'md5', true);

		// Realiza comunicação com o servidor
		$contents = file_get_contents($servidor, null, $context);
		$data = json_decode($contents);  //Parser da resposta Json
		//$hashts = $data['hashts'];
		
		if ($timestamp == $hashts) {
			$usuario = $data['usuario'];
			$menus = $data['menus'];
			$this->Session->write('menus',$menus);
			$this->Auth->login($usuario);
			$this->Session->setFlash(__('Login efetuado com sucesso.'));
			$this->redirect('/');
		} else {
			//$this->Session->setFlash(__('Tentativa de invasão do sistema.'));
		}		
	}
}
