<?php
class AuthBsComponent extends Component {

	public $components = array(
		'Session',
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
		),
		'AuthAdmin.AuthBs'
	);

	// Permissoes
	public function calcPerms($menus = null) {
		$perms = array();
		foreach ($menus as $menu) {
			foreach ($menu['Links'] as $link) {
				foreach ($link['children'] as $link_sub) {
					foreach ($link_sub['GruposLinksPermissoes'] as $perm) {
						$perms[$link_sub['Link']['controller']][$link_sub['Link']['action']][$perm['Permissao']['nome']] = true;
					}
				}
			}
		}
		return $perms;
	}

	public function authVars(&$controller) {
		// Verifica se há menus na Sessão e transfere para a view.
		//$this->Session->delete( 'menus' );
		if ( $this->Session->check( 'menus' ) ) {
			$menus = $this->Session->read( 'menus' );
			$controller->set( 'menus', $menus );
			$perms = $this->calcPerms($menus);
			$controller->set( 'perms', $perms );
		} else {
			if ($controller->params['controller'] != 'usuarios' and $controller->params['action'] != 'menus') {
				//$controller->redirect('http://login.vagr.com/menus?sistema_id=1');
			}
		}

		// Carrega dados do usuário e transfere para a view.
		$usuario = $this->Auth->user();
		$controller->set( 'usuario', $usuario );
	}

	function initialize(Controller $controller) {
        $this->authVars($controller);
    }
}