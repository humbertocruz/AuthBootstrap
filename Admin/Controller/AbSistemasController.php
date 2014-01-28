<?php
/**
 * Sistemas
 * Alteração: 09/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * data - variável gerada pelos métodos e enviada a view
 */

class AbSistemasController extends AbAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Sistemas');
	}

	public function view() {
		$this->AbSistema->AbGrupo->Behaviors->load('Containable');
		$this->AbSistema->AbGrupo->contain('AbSistema','AbGruposUsuario');

		$conditions = array(
			'AbGruposUsuario.usuario_id' => $this->Auth->user()['id']
		);
		$AbGrupos = $this->AbSistema->AbGrupo->AbGruposUsuario->find('list', array('fields'=>array('AbGruposUsuario.grupo_id','AbGruposUsuario.grupo_id'),'conditions'=>$conditions));
		$AbGrupos = explode(',', implode(',', $AbGrupos));
		$conditions = array(
			'AbGrupo.id IN' => $AbGrupos
		);

		$AbSistemas = $this->AbSistema->AbGrupo->find('all', array('conditions'));
		$this->set('AbSistemas',$AbSistemas);
	}

	public function index() {
		$data = $this->AbSistema->find('all');
		$this->set('data', $data);
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->AbSistema->create();
			$data = $this->request->data;
			if ($this->AbSistema->save($data)) {
				$this->Session->setFlash(__('Sistema salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$this->render('form');
		}
	}

	public function edit($id = null) {
		$this->AbSistema->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;
			if ($this->AbSistema->save($data)) {
				$this->Session->setFlash(__('Sistema salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AbSistema = $this->AbSistema->read();
			$this->request->data = $AbSistema;
			$this->render('form'); // Precisa estar no final da função
		}
	}
	
	public function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AbSistema->delete($id);
			$this->Session->setFlash(__('Sistema excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
