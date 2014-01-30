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
		if ($this->Auth->LoggedIn()) {
			$this->redirect(array('action'=>'menus.json?sistema_id='.$sistema_id));
		}
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if ($this->Auth->login()) {
				// Gera token para autenticação externa
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
		
		$isLogged = $this->Auth->loggedIn();
		$sistema_id = $this->request->query['sistema_id'];
		
		
		$sistema_id = $this->request->query['sistema_id'];
		$Sistema = $this->Sistema->read(null, $sistema_id);
		
		$this->set('sistema_url', $Sistema['Sistema']['url'].'/authenticate');
		
		$usuario = $this->Auth->user();
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
		$thistime = time();
		$data = array(
			'usuario' => $usuario,
			'menus' => $Menus,
			'hashts' => Security::hash( intval( $thistime/10 ), 'md5', true),
			'time' => $thistime
		);
		$this->set('data', urlencode( json_encode( $data ) ) );
	}
}
