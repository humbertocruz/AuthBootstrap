<?php
/**
 * AuthAPermissoes
 * Alteração: 04/12/2013
 * Humberto Cruz - desenvolvimento@apaebrasil.org.br
 * 
 * Variáveis
 * 
 * Permissao data - variável gerada pelos métodos e enviada a view
 */

class PermissoesController extends AdminAppController {

	public $uses = array('Admin.Permissao');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Permissões');
	}

	public function index() {
		$this->Permissao->GruposLinksPermissao->Grupo->Behaviors->load('Containable');
		$this->Permissao->GruposLinksPermissao->Grupo->contain(
			'Sistema',
			'GruposLinksPermissao',
			'GruposLinksPermissao.Link',
			'GruposLinksPermissao.Permissao'
		);
		$conditions = array(
			'Grupo.sistema_id' => $this->conditions['sistema_id']
		);
		$data = $this->Permissao->GruposLinksPermissao->Grupo->find('all',array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add($grupo_id = null) {
		if ($this->request->is('post')) {
			$this->Permissao->GruposLinksPermissao->create();
			$data = $this->request->data;
			// Carrega condicoes do sistema
			$data['GruposLinksPermissao']['grupo_id'] = $grupo_id;
			// Tenta salvar
			if ($this->Permissao->GruposLinksPermissao->save($data)) {
				$this->Session->setFlash(__('Permissao salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$Menus = $this->Permissao->GruposLinksPermissao->Link->Menu->find(
				'list', 
					array(
						'fields'=>array('id'),
						'conditions'=>array('Menu.grupo_id'=>$grupo_id)
					)
			);
			$this->set('Links', $this->Permissao->GruposLinksPermissao->Link->find(
				'list', 
					array(
						'fields'=>array('id','text'),
						'conditions' => array(
							'Link.menu_id' => $Menus
						)
					)
				)
			);
			$this->set('Permissoes', $this->Permissao->find('list', array('fields'=>array('id','nome'))));
		}
		$this->render('form');
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->Permissao->GruposLinksPermissao->delete($id);
			$this->Session->setFlash(__('Permissao excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
