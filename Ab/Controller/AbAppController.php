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

		// Menus
		if ($this->Session->check('menus')) {
			$this->set('menus', $this->Session->read('menus'));
			$this->menus = $this->Session->read('menus');
		}

		// Layout bootstrap
		$this->layout = 'Ab.bootstrap';

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
