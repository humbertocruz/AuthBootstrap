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

class AbMenusController extends AbAppController {

	public $uses = array('Ab.AbMenu');

	public function index() {
		$this->AbMenu->Behaviors->load('Containable');
		$this->AbMenu->contain(
			'AbGrupo'
		);

		$conditions = array();
		$conditions['AbGrupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->AbMenu->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->AbMenu->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['AbMenu']['menu_id'] = $this->conditions_menu_id;

			// Tenta salvar
			if ($this->AbMenu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$conditions = array(
				'AbGrupo.sistema_id' => $this->conditions['sistema_id']
			);
			$AbGrupos = $this->Menu->AbGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('AbGrupos', $AbGrupos);
			$this->render('form');
		}
	}

	public function edit($id = null) {
		$this->AbMenu->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->AbMenu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AbMenu = $this->AbMenu->read();
			$this->request->data = $AbMenu;
			$conditions = array(
				'AbGrupo.sistema_id' => $this->conditions['sistema_id']
			);
			$AbGrupos = $this->AbMenu->AbGrupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('AbGrupos', $AbGrupos);
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AbMenu->AbLink->deleteAll(array('AbLink.menu_id'=>$id));
			$this->AbMenu->delete($id);

			$this->Session->setFlash(__('Menu excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
