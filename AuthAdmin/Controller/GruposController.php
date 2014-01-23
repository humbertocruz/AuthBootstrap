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

class GruposController extends AppController {

	public function index() {
		$conditions = array();
		$conditions = array();
		$conditions['Grupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->Grupo->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Grupo->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['Grupo']['sistema_id'] = $this->conditions['sistema_id'];

			pr($data);

			// Tenta salvar
			if ($this->Grupo->save($data)) {
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
		$this->Grupo->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->Grupo->save($data)) {
				$this->Session->setFlash(__('Grupo salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$Grupo = $this->Grupo->read();
			$this->request->data = $Grupo;
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->Grupo->delete($id);
			$this->Session->setFlash(__('Grupo excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
