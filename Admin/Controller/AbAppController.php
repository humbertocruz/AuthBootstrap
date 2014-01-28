<?php
class AbAppController extends AppController {

	public $layout = 'bootstrap';
	public $helpers = array(
		'Session',
		'Ab.AuthBs'
	);
	public $components = array(
		'Session',
		'Ab.AuthBs',
		'Auth'=>array(
			'loginAction' => array(
				'plugin' => 'Ab',
				'controller' => 'AbAuthenticator',
				'action' => 'authenticate'
			),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Ab.AbUsuario',
					'fields' => array(
						'username' => 'usuario',
						'password' => 'senha'
					)
				)
			)
		)
	);

	public $uses = array('Ab.AbSistema');


	public function beforeRender() {
		//Lista dos sistemas para o Menu deste Sistema
		
		$SistemasMenu = $this->AbSistema->find( 'list', array( 'fields'=>array( 'id', 'nome' ) ) );
		$SistemasMenu = array( 0=>'Selecione o Sistema' ) + $SistemasMenu;
		$this->set( 'SistemasMenu', $SistemasMenu );
		
	}

	public function beforeFilter() {
		// Remover após configurar a senha do usuario inicial (bootstrap)
		//$this->set('init_password',$this->Auth->password('authbootstrap'));
		// Copie a senha para o usuario bootstrap no banco de dados

		// Menus
		if ($this->Session->check('menus')) {
			$this->set('menus', $this->Session->read('menus'));
			$this->menus = $this->Session->read('menus');

			$this->set('usuario', $this->Auth->user());
		}

		// Breadcrumb
		switch ($this->action) {
			case 'index':
				$this->set('formatedAction','Listagem');
				break;
			case 'add':
				$this->set('formatedAction','Adicionar');
				break;
			case 'edit':
				$this->set('formatedAction','Editar');
				break;
			default:
				$this->set('formatedAction','...');
				break;
		}

		// Layout bootstrap
		//$this->layout = 'Ab.bootstrap'; //Layout básico
		$this->layout = 'Ab.bootstrap-admin'; //Layout para o Admin

		/**
		* Condições de pesquisa pode ser acessada sempre que necessárias. Disponivel em $this->conditions para os controllers
		* como $conditions para as views.
		*
		* sistema_id = Mantém o ID do sistema selecionado no menu
		*
		**/
		// Carrega condições de Pesquisa
		if ($this->request->is('post')) {
			if (isset($this->request->data['Conditions']['sistema_id'])) {
				$data = $this->request->data;
				$conditions_sistema_id = $data['Conditions']['sistema_id'];
				$this->Session->write( 'Conditions.sistema_id', $conditions_sistema_id );
			}
		}
		$conditions = $this->Session->read( 'Conditions' );
		$this->conditions = $conditions;
		$this->set( 'conditions', $conditions );

		$this->conditions_sistema_id =  $this->Session->read('Conditions.sistema_id');
		$this->set('conditions_sistema_id', $this->Session->read('Conditions.sistema_id'));

		$this->conditions =  $this->Session->read('Conditions');
		$this->set('conditions', $this->Session->read('Conditions'));

	}
	
}
