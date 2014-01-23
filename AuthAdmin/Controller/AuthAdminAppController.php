<?php
class AuthAdminAppController extends AppController {
	
	// Models que o controller pai deve acessar
	public $uses = array(
		'Sistema',
		'Menu'
	);

	public $helpers = array(
		'Session',
		'AuthBootstrap.AuthBs'
	);

	// Autenticação FENAPAES
	/*
	 * O sistema de autenticação verifica se o usuario está logado, se não estiver, faz uma requisicao ao
	 * Site de Autenticação e espera pela resposta. Se estiver conetado no site, faz o login automaticamente
	 * nesse sistema e continua. Se lá não estiver logado, então desvia para o a página de login do site de
	 * autenticação enviando uma variavel com o sistema_id para voltar automaticamente.
	 *
	 *
	public $components = array(
		'Session',
		'AuthBootstrap.AuthBs',
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
		)
	);
	*/

	public function beforeRender() {
		//Lista dos sistemas para o Menu deste Sistema
		$SistemasMenu = $this->Sistema->find( 'list', array( 'fields'=>array( 'id', 'nome' ) ) );
		$SistemasMenu = array( 0=>'Selecione o Sistema' ) + $SistemasMenu;
		$this->set( 'SistemasMenu', $SistemasMenu );
	}

	public function beforeFilter() {
		// Layout bootstrap
		$this->layout = 'AuthBootstrap.bootstrap';

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
