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

class AbGruposController extends AbAppController {

	public $uses = array('Ab.AbGrupo');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Grupos');
	}

	public function index() {
		$conditions = array();
		$conditions = array();
		$conditions['AbGrupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->AbGrupo->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->AbGrupo->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['AbGrupo']['sistema_id'] = $this->conditions['sistema_id'];

			// Tenta salvar
			if ($this->AbGrupo->save($data)) {
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
		$this->AbGrupo->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->AbGrupo->save($data)) {
				$this->Session->setFlash(__('Grupo salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AbGrupo = $this->AbGrupo->read();
			$this->request->data = $AbGrupo;
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AbGrupo->delete($id);
			$this->Session->setFlash(__('Grupo excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
