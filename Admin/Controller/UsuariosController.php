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

class UsuariosController extends AdminAppController {

	public $uses = array('Admin.Usuario');

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
		$Usuarios = $this->Paginate($this->Usuario);
		$this->set('data', $Usuarios);
	}

	public function add() {
		if ($this->request->is('post')) {
			if ( strlen( $this->request->data['Usuario']['senha'] ) < 8 ) {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			} else {
				$this->Usuario->create();
				$this->Usuario->GruposUsuario->create();
				$data = $this->request->data;
				if ( strlen( $data['Usuario']['senha'] ) < 8 and strlen( $data['Usuario']['senha'] ) > 1 ) {
					$this->Session->setFlash(__('Não foi possível gravar, senha pequena.'));
				} else {
					if (strlen( $data['Usuario']['senha'] ) == 0) {
						unset($data['Usuario']['senha']);
					} else {
						$data['Usuario']['senha'] = $this->Auth->password($data['Usuario']['senha']);
					}
					if ($this->Usuario->saveAll($data)) {
						$this->Usuario->GruposUsuario->save($data['GruposUsuario']); // sem isso salva o grupo_id como zero
						$this->Session->setFlash(__('Usuário salvo com sucesso.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Não foi possível gravar.'));
					}
				}
			}
		}
		$conditions = array(
			'Grupo.sistema_id' => $this->conditions_sistema_id
		);
		$Grupos = $this->Usuario->GruposUsuario->Grupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('Grupos', $Grupos);
		$this->render('form');
	}

	public function edit($id = null) {
		$this->Usuario->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;
			if ( strlen( $data['Usuario']['senha'] ) < 8 and strlen( $data['Usuario']['senha'] ) > 1 ) {
				$this->Session->setFlash(__('Não foi possível gravar, senha pequena.'));
			} else {
				if (strlen( $data['Usuario']['senha'] ) == 0) {
					unset($data['Usuario']['senha']);
				}
				if ($this->Usuario->saveAll($data)) {
					$this->Session->setFlash(__('Usuário salvo com sucesso.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Não foi possível gravar.'));
				}
			}
		}
		$Usuario = $this->Usuario->read();
		$this->request->data = $Usuario;
		$conditions = array(
			'Grupo.sistema_id' => $this->conditions_sistema_id
		);
		$Grupos = $this->Usuario->GruposUsuario->Grupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('Grupos', $Grupos);
		$this->render('form'); // Precisa estar no final da função
	}
	
	public function delete($id = null) {
		if ($this->request->is('post')) {
			$this->Usuario->delete($id);
			$this->Session->setFlash(__('Usuário excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
