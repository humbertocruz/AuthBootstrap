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

class UsuariosController extends AuthBootstrapAppController {

	public function authenticate() {
		$usuario = $this->data['usuario'];
		$menus = $this->data['menus'];

		$usuario = json_decode( urldecode( $usuario ), true );
		$menus = json_decode( urldecode( $menus ), true );

		$this->Session->write('menus',$menus);
		$this->Auth->login($usuario);

		$this->redirect('/');
	}

}
