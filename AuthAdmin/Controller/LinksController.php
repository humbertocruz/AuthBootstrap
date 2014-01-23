<?php
/**
 * Links
 * Alteração: 04/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * data - variável gerada pelos métodos e enviada a view
 */

class LinksController extends AppController {

	public function index($menu_id = null) {
		$conditions = array('Link.menu_id'=>$menu_id);
		$this->set('menu_id', $menu_id);

		$orderby = array();

		if ($menu_id) {
			$menu = $this->Link->Menu->read(null, $menu_id);
			
			$orderby['Link.'.$menu['Menu']['orderby']] = 'ASC';
		}

		$grupos = $this->Link->Menu->Grupo->find('list', array('fields'=>array('id'),'conditions'=>array('Grupo.sistema_id'=>$this->conditions['sistema_id'])));

		if ($grupos) {
			$conditions = array(
				'Menu.grupo_id ' => $grupos
			);
		} else $conditions = array('Menu.grupo_id'=>0);
		
		$menus_list = $this->Link->Menu->find('list', array('conditions'=>$conditions, 'fields'=>array('id','title')));
		$menus_list = array(0=>'Selecione o Menu') + $menus_list;
		$this->set('menus_list', $menus_list);

		$conditions = array('Link.menu_id'=>$menu_id);

		$data = $this->Link->find('threaded', array('conditions'=>$conditions, 'order'=>$orderby));
		$this->set('data', $data);

	}

	public function add($id = null, $menu_id = null) {
		if ($this->request->is('post')) {
			$this->Link->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			if ($id == 0) $id = null;
			$data['Link']['menu_id'] = $menu_id;
			$data['Link']['parent_id'] = $id;
			
			// Tenta salvar
			
			if ($this->Link->save($data)) {
				$this->Session->setFlash(__('Link salvo com sucesso.'));
                return $this->redirect(array('action' => 'index', $menu_id));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
            
		} else {
			$menus_list = $this->Link->Menu->find('list', array('fields'=>array('id','title')));
			$this->set('menus_list', $menus_list);
		}
		$this->render('form');
	}

	public function edit($id = null, $menu_id = null) {
		$this->Link->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->Link->save($data)) {
				$this->Session->setFlash(__('Link salvo com sucesso.'));
				return $this->redirect(array('action' => 'index', $menu_id));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$Link = $this->Link->read();
			$this->request->data = $Link;
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null, $menu_id) {
		if ($this->request->is('post')) {
			// Deleta o registro
			$this->Link->delete($id);
			// Delete seus filhos
			$this->Link->deleteAll(array('Link.parent_id'=>$id));

			$this->Session->setFlash(__('Link excluído com sucesso.'));
			return $this->redirect(array('action' => 'index', $menu_id));
		}
	}
}
