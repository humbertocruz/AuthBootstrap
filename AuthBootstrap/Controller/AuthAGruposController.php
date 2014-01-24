<?php
/**
 * Grupos
 * Alteração: 04/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * data - variável gerada pelos métodos e enviada a view
 */

class AuthAGruposController extends AppController {

	public function index() {
		$conditions = array();
		$conditions = array();
		$conditions['AuthAGrupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->AuthAGrupo->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->AuthAGrupo->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['AuthAGrupo']['sistema_id'] = $this->conditions['sistema_id'];

			pr($data);

			// Tenta salvar
			if ($this->AuthAGrupo->save($data)) {
				$this->Session->setFlash(__('Grupo salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$this->render('form');
		}
	}

	public function edit($id = null) {
		$this->AuthAGrupo->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->AuthAGrupo->save($data)) {
				$this->Session->setFlash(__('Grupo salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AuthAGrupo = $this->AuthAGrupo->read();
			$this->request->data = $AuthAGrupo;
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AuthAGrupo->delete($id);
			$this->Session->setFlash(__('Grupo excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
