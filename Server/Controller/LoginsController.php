 <?php
App::uses('Controller', 'Controller');


class LoginsController extends ServerAppController {
	

	public $components = array(
 		'RequestHandler'
	 );
	
	public $uses = array('Server.Usuario','Server.Grupo','Server.Menu','Server.Sistema');

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
				if(isset($this->data['Usuario']['sistema_id'])) {
					$Sistema = $this->Sistema->read(null, $this->data['Usuario']['sistema_id']);
					$this->redirect($Sistema['Sistema']['url']);
				}
				$this->redirect(array('plugin'=>'server','controller'=>'sistemas','action'=>'view'));
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
		$this->layout = false;
		$isLogged = $this->Auth->loggedIn();
		$sistema_id = $this->request->query['sistema_id'];
		if ( !$isLogged ) {
			//$this->redirect('/login?sistema_id='.$sistema_id);
			$this->set('data', array());
			$this->set('_serialize', array('data'));
		} else {
			$usuario = $this->Auth->user();
			$sistema_id = $this->request->query['sistema_id'];
			$Sistema = $this->Sistema->read(null, $sistema_id);
			$this->set('sistema_url', $Sistema['Sistema']['url'].'/authenticate');
			
			$grupos_usuario = $this->Grupo->GruposUsuario->find('list', array('fields'=>array('grupo_id'),'conditions'=>array('GruposUsuario.usuario_id'=>$usuario['id'])));
	
			$grupo_cond = array(
				'Grupo.sistema_id' => $sistema_id,
				'Grupo.id'=> $grupos_usuario
			);

			$Grupo = $this->Grupo->find('first', array('conditions'=>$grupo_cond, 'recursive'=>'0') );

			$menu_cond = array(
				'Menu.grupo_id' => $Grupo['Grupo']['id']
			);
			
			$Menus = $this->Menu->find('all', array('conditions'=>$menu_cond,'recursive'=>'-1'));

			if (isset($Menus)) {
				$count = 0;
				foreach ($Menus as $menu) {
					$link_cond = array(
						'Link.menu_id' => $menu['Menu']['id']
					);
					$this->Menu->Link->Behaviors->load('Containable');
					$this->Menu->Link->contain(
						'GruposLinksPermissao',
						'GruposLinksPermissao.Permissao'
					);
					$Menus[$count]['Links'] = $this->Menu->Link->find('threaded', array('conditions'=>$link_cond));
					$count++;
				}
			} else {
				$Menus = array();
			}

			$login = array(
				'Login' => array(
					'sistema_id' => $sistema_id,
					'usuario_id' => $usuario['id']
				)
			);
			$this->Usuario->Login->save($login);
			$data = array(
				'usuario' => $usuario,
				'menus' => $Menus,
				'hashts' => Security::hash( intval( time()/10 ), 'md5', true)
			);
			//echo(json_encode($data));
			$this->set('data', $data);
			$this->set('_serialize', array('data'));

		}
	}
}
