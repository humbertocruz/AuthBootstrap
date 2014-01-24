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

class AuthAUsuariosController extends AuthAdminAppController {

	public function index() {
		$AuthAUsuarios = $this->Paginate($this->AuthAUsuario);
		$this->set('data', $AuthAUsuarios);
	}

	public function add() {
		if ($this->request->is('post')) {
			if ( strlen( $this->request->data['Usuario']['senha'] ) < 8 ) {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			} else {
				$this->AuthAUsuario->create();
				$data = $this->request->data;
				if ($this->AuthAUsuario->save($data)) {
					$this->Session->setFlash(__('Usuário salvo com sucesso.'));
                	$this->redirect(array('action' => 'index'));
            	} else {
            		$this->Session->setFlash(__('Não foi possível gravar.'));
            	}
			}
		}
		$conditions = array(
			'AuthAGrupo.sistema_id' => $this->conditions_sistema_id
		);
		$AuthAGrupos = $this->AuthAUsuario->AuthAGruposUsuario->AuthAGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('AuthAGrupos', $AuthAGrupos);
		$this->render('form');
	}

	public function edit($id = null) {
		$this->AuthAUsuario->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;
			if ( strlen( $data['AuthAUsuario']['senha'] ) < 8 and strlen( $data['AuthAUsuario']['senha'] ) > 1 ) {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			} else {
				if (strlen( $data['AuthAUsuario']['senha'] ) == 0) {
					unset($data['AuthAUsuario']['senha']);
				}
				if ($this->AuthAUsuario->save($data)) {
					$this->Session->setFlash(__('Usuário salvo com sucesso.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Não foi possível gravar.'));
				}
			}
		}
		$AuthAUsuario = $this->AuthAUsuario->read();
		$this->request->data = $AuthAUsuario;
		$conditions = array(
			'AuthAGrupo.sistema_id' => $this->conditions_sistema_id
		);
		$AuthAGrupos = $this->AuthAUsuario->AuthAGruposUsuario->AuthAGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
		$this->set('grupos', $AuthAGrupos);
		$this->render('form'); // Precisa estar no final da função
	}
	
	public function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AuthAUsuario->delete($id);
			$this->Session->setFlash(__('Usuário excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
