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

class AuthASistemasController extends AppController {

	public function index() {
		$data = $this->AuthASistema->find('all');
		$this->set('data', $data);
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Sistema->create();
			$data = $this->request->data;
			if ($this->AuthASistema->save($data)) {
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
		$this->AuthASistema->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;
			if ($this->AuthASistema->save($data)) {
				$this->Session->setFlash(__('Sistema salvo com sucesso.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AuthASistema = $this->AuthASistema->read();
			$this->request->data = $AuthASistema;
			$this->render('form'); // Precisa estar no final da função
		}
	}
	
	public function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AuthASistema->delete($id);
			$this->Session->setFlash(__('Sistema excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

}
