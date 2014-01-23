 <?php
App::uses('Controller', 'Controller');

class LoginController extends AuthLoginAppController {
	
	public $uses = array('AuthLogin.Usuario','AuthLogin.Grupo','AuthLogin.Menu','AuthLogin.Sistema');

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
					$sistema = $this->Sistema->read(null, $this->data['Usuario']['sistema_id']);
					$this->redirect($sistema['Sistema']['url']);
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

			$sistema = $this->Sistema->read(null, $sistema_id);
			$this->set('login_url', $sistema['Sistema']['url'].'/authenticate');
			
			$grupos_usuario = $this->Grupo->GruposUsuario->find('list', array('fields'=>array('grupo_id'),'conditions'=>array('GruposUsuario.usuario_id'=>$usuario['id'])));
	
			$grupo_cond = array(
				'Grupo.sistema_id' => $sistema_id,
				'Grupo.id'=> $grupos_usuario
			);

			$grupo = $this->Grupo->find('first', array('conditions'=>$grupo_cond, 'recursive'=>'0') );

			$menu_cond = array(
				'Menu.grupo_id' => $grupo['Grupo']['id']
			);
			
			$menus = $this->Menu->find('all', array('conditions'=>$menu_cond,'recursive'=>'-1'));

			if ($menus) {
				$count = 0;
				foreach ($menus as $menu) {
					$link_cond = array(
						'Link.menu_id' => $menu['Menu']['id']
					);
					$this->Menu->Link->Behaviors->load('Containable');
					$this->Menu->Link->contain(
						'GruposLinksPermissoes',
						'GruposLinksPermissoes.Permissao'
					);
					$menus[$count]['Links'] = $this->Menu->Link->find('threaded', array('conditions'=>$link_cond));
					$count++;
				}
			} else {
				$menus = array();
			}

			$login = array(
				'Login' => array(
					'sistema_id' => $sistema_id,
					'usuario_id' => $usuario['id']
				)
			);
			$this->Usuario->Login->save($login);
			$this->set('data', array(
				'usuario' => $usuario,
				'menus' => $menus,
				'hashts' => Security::hash( intval( time()/10 ), 'md5', true)
			));
		}
	}
}
