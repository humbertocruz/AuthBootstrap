 <?php
App::uses('Controller', 'Controller');

class AuthLLoginController extends AuthLoginAppController {
	
	public $uses = array('AuthLogin.AuthLUsuario','AuthLogin.AuthLGrupo','AuthLogin.AuthLMenu','AuthLogin.AuthLSistema');

	public function logout() {
		$this->Session->delete('menus');
		$this->Auth->logout();
		$this->redirect('/');
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if(isset($this->data['Usuario']['sistema_id'])) {
					$this->Session->setFlash(__('Usuários Logado com Sucesso!'));
					$AuthLSistema = $this->AuthLSistema->read(null, $this->data['AuthLUsuario']['sistema_id']);
					$this->redirect($AuthLSistema['AuthLSistema']['url']);
				}
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		} else {
			if ( isset( $this->request->query['sistema_id'] ) ) {
				$this->set('sistema_id', $this->request->query['sistema_id'] );
			}
		}
	}
	
	public function menus() {

		$isLogged = $this->Auth->loggedIn();
		$sistema_id = $this->request->query['sistema_id'];
		
		if ( !$isLogged ) {
			$this->redirect('/login?sistema_id='.$sistema_id);
		} else {
			$usuario = $this->Auth->user();
			$sistema_id = $this->request->query['sistema_id'];

			$AuthLSistema = $this->AuthLSistema->read(null, $sistema_id);
			$this->set('login_url', $AuthLSistema['AuthLSistema']['url'].'/authenticate');
			
			$grupos_usuario = $this->AuthLGrupo->AuthLGruposUsuario->find('list', array('fields'=>array('grupo_id'),'conditions'=>array('GruposUsuario.usuario_id'=>$usuario['id'])));
	
			$grupo_cond = array(
				'AuthLGrupo.sistema_id' => $sistema_id,
				'AuthLGrupo.id'=> $grupos_usuario
			);

			$AuthLGrupo = $this->AuthLGrupo->find('first', array('conditions'=>$grupo_cond, 'recursive'=>'0') );

			$menu_cond = array(
				'AuthLMenu.grupo_id' => $AuthLGrupo['AuthLGrupo']['id']
			);
			
			$AuthLMenus = $this->AuthLMenu->find('all', array('conditions'=>$menu_cond,'recursive'=>'-1'));

			if ($menus) {
				$count = 0;
				foreach ($menus as $menu) {
					$link_cond = array(
						'AuthLLink.menu_id' => $menu['AuthLMenu']['id']
					);
					$this->AuthLMenu->AuthLLink->Behaviors->load('Containable');
					$this->AuthLMenu->AuthLLink->contain(
						'AuthLGruposLinksPermissoes',
						'AuthLGruposLinksPermissoes.AuthLPermissao'
					);
					$menus[$count]['Links'] = $this->AuthLMenu->AuthLLink->find('threaded', array('conditions'=>$link_cond));
					$count++;
				}
			} else {
				$menus = array();
			}

			$login = array(
				'AuthLLogin' => array(
					'sistema_id' => $sistema_id,
					'usuario_id' => $usuario['id']
				)
			);
			$this->AuthLUsuario->AuthLLogin->save($login);
			$this->set('data', array(
				'usuario' => $usuario,
				'menus' => $menus,
				'hashts' => Security::hash( intval( time()/10 ), 'md5', true)
			));
		}
	}
}
