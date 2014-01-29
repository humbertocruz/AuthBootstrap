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

class MenusController extends AdminAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Menus');
	}

	public $uses = array('Admin.Menu');

	public function index() {
		$this->Menu->Behaviors->load('Containable');
		$this->Menu->contain(
			'Grupo'
		);

		$conditions = array();
		$conditions['Grupo.sistema_id'] = $this->conditions['sistema_id'];

		$data = $this->Menu->find('all', array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			$data['Menu']['menu_id'] = $this->conditions_menu_id;

			// Tenta salvar
			if ($this->Menu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$conditions = array(
				'Grupo.sistema_id' => $this->conditions['sistema_id']
			);
			$Grupos = $this->Menu->Grupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('Grupos', $Grupos);
			$this->render('form');
		}
	}

	public function edit($id = null) {
		$this->Menu->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->Menu->save($data)) {
				$this->Session->setFlash(__('Menu salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$Menu = $this->Menu->read();
			$this->request->data = $Menu;
			$conditions = array(
				'Grupo.sistema_id' => $this->conditions['sistema_id']
			);
			$Grupos = $this->Menu->Grupo->find('list', array('fields'=>array('id','nome'),'conditions'=>$conditions));
			$this->set('Grupos', $Grupos);
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->Menu->Link->deleteAll(array('Link.menu_id'=>$id));
			$this->Menu->delete($id);

			$this->Session->setFlash(__('Menu excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
