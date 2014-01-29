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

class LinksController extends AdminAppController {

	public $uses = array('Ab.AbLink');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Links');
	}

	public function index($menu_id = null) {
		$conditions = array('AbLink.menu_id'=>$menu_id);
		$this->set('menu_id', $menu_id);

		$orderby = array();

		if ($menu_id) {
			$menu = $this->AbLink->AbMenu->read(null, $menu_id);
			
			$orderby['AbLink.'.$menu['AbMenu']['orderby']] = 'ASC';
		}

		$AbGrupos = $this->AbLink->AbMenu->AbGrupo->find('list', array('fields'=>array('id'),'conditions'=>array('AbGrupo.sistema_id'=>$this->conditions['sistema_id'])));

		if ($AbGrupos) {
			$conditions = array(
				'AbMenu.grupo_id ' => $AbGrupos
			);
		} else $conditions = array('AbMenu.grupo_id'=>0);
		
		$menus_list = $this->AbLink->AbMenu->find('list', array('conditions'=>$conditions, 'fields'=>array('id','title')));
		$menus_list = array(0=>'Selecione o Menu') + $menus_list;
		$this->set('menus_list', $menus_list);

		$conditions = array('AbLink.menu_id'=>$menu_id);

		$data = $this->AbLink->find('threaded', array('conditions'=>$conditions, 'order'=>$orderby));
		$this->set('data', $data);

	}

	public function add($id = null, $menu_id = null) {
		if ($this->request->is('post')) {
			$this->AbLink->create();
			$data = $this->request->data;

			// Carrega condicoes do sistema
			if ($id == 0) $id = null;
			$data['AbLink']['menu_id'] = $menu_id;
			$data['AbLink']['parent_id'] = $id;
			
			// Tenta salvar
			
			if ($this->AbLink->save($data)) {
				$this->Session->setFlash(__('Link salvo com sucesso.'));
                return $this->redirect(array('action' => 'index', $menu_id));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
            
		} else {
			$menus_list = $this->AbLink->AbMenu->find('list', array('fields'=>array('id','title')));
			$this->set('menus_list', $menus_list);
		}
		$this->render('form');
	}

	public function edit($id = null, $menu_id = null) {
		$this->AbLink->id = $id;
		
		if ($this->request->is('put')) {
			$data = $this->request->data;

			// Tenta atualizar
			if ($this->AbLink->save($data)) {
				$this->Session->setFlash(__('Link salvo com sucesso.'));
				return $this->redirect(array('action' => 'index', $menu_id));
			} else {
				$this->Session->setFlash(__('Não foi possível gravar.'));
			}
		} else {
			$AbLink = $this->AbLink->read();
			$this->request->data = $AbLink;
			$this->render('form'); // Precisa estar no final da função
		}
	}

	function delete($id = null, $menu_id) {
		if ($this->request->is('post')) {
			// Deleta o registro
			$this->AbLink->delete($id);
			// Delete seus filhos
			$this->AbLink->deleteAll(array('Link.parent_id'=>$id));

			$this->Session->setFlash(__('Link excluído com sucesso.'));
			return $this->redirect(array('action' => 'index', $menu_id));
		}
	}
}
