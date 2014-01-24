<?php
/**
 * Menus
 * Alteração: 04/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * data - variável gerada pelos métodos e enviada a view
 */

class AuthAMenusController extends AppController {

	public function index() {
		$this->AuthAMenu->Behaviors->load('Containable');
		$this->AuthAMenu->contain(
			'AuthAGrupo'
		);

		$conditions = array();
		$conditions['AuthAGrupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->AuthAMenu->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->AuthAMenu->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['AuthAMenu']['menu_id'] = $this->conditions_menu_id;

			// Tenta salvar
			if ($this->AuthAMenu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$conditions = array(
				'AuthAGrupo.sistema_id' => $this->conditions['sistema_id']
			);
			$AuthAGrupos = $this->Menu->AuthAGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('AuthAGrupos', $Grupos);
			$this->render('form');
		}
	}

	public function edit($id = null) {
		$this->AuthAMenu->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->AuthAMenu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AuthAMenu = $this->Menu->read();
			$this->request->data = $AuthAMenu;
			$conditions = array(
				'AuthAGrupo.sistema_id' => $this->conditions['sistema_id']
			);
			$AuthAGrupos = $this->AuthAMenu->AuthAGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('AuthAGrupos', $AuthAGrupos);
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AuthAMenu->AuthALink->deleteAll(array('AuthALink.menu_id'=>$id));
			$this->AuthAMenu->delete($id);

			$this->Session->setFlash(__('Menu excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
