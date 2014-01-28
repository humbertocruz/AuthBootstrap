 <?php
App::uses('Controller', 'Controller');

class LoginsController extends LoginAppController {
	
	
	public $uses = array('Ab.AbUsuario','Ab.AbGrupo','Ab.AbMenu','Ab.AbSistema');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login','logout','menus');
		$this->set('formatedName','Login');
	}

	public function logout() {
		$this->Session->delete('menus');
		$this->Auth->logout();
		
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Usuários Logado com Sucesso!'));
				if(isset($this->data['AbUsuario']['sistema_id'])) {
					$AbSistema = $this->AbSistema->read(null, $this->data['AbUsuario']['sistema_id']);
					$this->redirect($AbSistema['AbSistema']['url']);
				}
				$this->redirect(array('plugin'=>'ab','controller'=>'ab_sistemas','action'=>'view'));
			} else {
				$this->Session->setFlash(__('Usuário ou Senha inválidos, tente novamente.'));
			}
		} else {
			if ( isset( $this->request->query['sistema_id'] ) ) {
				$this->set('sistema_id', $this->request->query['sistema_id'] );
			}
		}
	}
	
	public function menus() {
		//$this->layout = 'ajax';
		$isLogged = $this->Auth->loggedIn();
		$sistema_id = $this->request->query['sistema_id'];
		if ( !$isLogged ) {
			$this->redirect('/login?sistema_id='.$sistema_id);
		} else {
			$usuario = $this->Auth->user();
			$sistema_id = $this->request->query['sistema_id'];
			$AbSistema = $this->AbSistema->read(null, $sistema_id);
			$this->set('sistema_url', $AbSistema['AbSistema']['url'].'/authenticate');
			
			$grupos_usuario = $this->AbGrupo->AbGruposUsuario->find('list', array('fields'=>array('grupo_id'),'conditions'=>array('AbGruposUsuario.usuario_id'=>$usuario['id'])));
	
			$grupo_cond = array(
				'AbGrupo.sistema_id' => $sistema_id,
				'AbGrupo.id'=> $grupos_usuario
			);

			$AbGrupo = $this->AbGrupo->find('first', array('conditions'=>$grupo_cond, 'recursive'=>'0') );

			$menu_cond = array(
				'AbMenu.grupo_id' => $AbGrupo['AbGrupo']['id']
			);
			
			$AbMenus = $this->AbMenu->find('all', array('conditions'=>$menu_cond,'recursive'=>'-1'));

			if (isset($AbMenus)) {
				$count = 0;
				foreach ($AbMenus as $menu) {
					$link_cond = array(
						'AbLink.menu_id' => $menu['AbMenu']['id']
					);
					$this->AbMenu->AbLink->Behaviors->load('Containable');
					$this->AbMenu->AbLink->contain(
						'AbGruposLinksPermissao',
						'AbGruposLinksPermissao.AbPermissao'
					);
					$AbMenus[$count]['AbLinks'] = $this->AbMenu->AbLink->find('threaded', array('conditions'=>$link_cond));
					$count++;
				}
			} else {
				$AbMenus = array();
			}

			$login = array(
				'AbLogin' => array(
					'sistema_id' => $sistema_id,
					'usuario_id' => $usuario['id']
				)
			);
			$this->AbUsuario->AbLogin->save($login);
			$this->set('data', array(
				'usuario' => $usuario,
				'menus' => $AbMenus,
				'hashts' => Security::hash( intval( time()/10 ), 'md5', true)
			));
		}
	}
}
