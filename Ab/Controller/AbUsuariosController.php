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

class AbUsuariosController extends AbAppController {

	public $uses = array('Ab.AbUsuario');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Usuários');
	}

	public function home() {
		if (!$this->Session->check('menus')) {
			//echo (Configure::read('menus_url').'?sistema_id='.Configure::read('sistema_id'));
			$this->redirect(Configure::read('menus_url').'?sistema_id='.Configure::read('sistema_id'));
		}
	}

	public function index() {
		$AbUsuarios = $this->Paginate($this->AbUsuario);
		$this->set('data', $AbUsuarios);
	}

	public function add() {
		if ($this->request->is('post')) {
			if ( strlen( $this->request->data['AbUsuario']['senha'] ) < 8 ) {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			} else {
				$this->AbUsuario->create();
				$this->AbUsuario->AbGruposUsuario->create();
				$data = $this->request->data;
				if ( strlen( $data['AbUsuario']['senha'] ) < 8 and strlen( $data['AbUsuario']['senha'] ) > 1 ) {
					$this->Session->setFlash(__('Não foi possível gravar, senha pequena.'));
				} else {
					if (strlen( $data['AbUsuario']['senha'] ) == 0) {
						unset($data['AbUsuario']['senha']);
					} else {
						$data['AbUsuario']['senha'] = $this->Auth->password($data['AbUsuario']['senha']);
					}
					if ($this->AbUsuario->saveAll($data)) {
						$this->AbUsuario->AbGruposUsuario->save($data['AbGruposUsuario']); // sem isso salva o grupo_id como zero
						$this->Session->setFlash(__('Usuário salvo com sucesso.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Não foi possível gravar.'));
					}
				}
			}
		}
		$conditions = array(
			'AbGrupo.sistema_id' => $this->conditions_sistema_id
		);
		$AbGrupos = $this->AbUsuario->AbGruposUsuario->AbGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('AbGrupos', $AbGrupos);
		$this->render('form');
	}

	public function edit($id = null) {
		$this->AbUsuario->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;
			if ( strlen( $data['AbUsuario']['senha'] ) < 8 and strlen( $data['AbUsuario']['senha'] ) > 1 ) {
				$this->Session->setFlash(__('Não foi possível gravar, senha pequena.'));
			} else {
				if (strlen( $data['AbUsuario']['senha'] ) == 0) {
					unset($data['AbUsuario']['senha']);
				}
				if ($this->AbUsuario->saveAll($data)) {
					$this->Session->setFlash(__('Usuário salvo com sucesso.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Não foi possível gravar.'));
				}
			}
		}
		$AbUsuario = $this->AbUsuario->read();
		$this->request->data = $AbUsuario;
		$conditions = array(
			'AbGrupo.sistema_id' => $this->conditions_sistema_id
		);
		$AbGrupos = $this->AbUsuario->AbGruposUsuario->AbGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('AbGrupos', $AbGrupos);
		$this->render('form'); // Precisa estar no final da função
	}
	
	public function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AbUsuario->delete($id);
			$this->Session->setFlash(__('Usuário excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
