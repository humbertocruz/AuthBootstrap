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

class AuthAPermissoesController extends AuthAdminAppController {

	public function index() {
		$this->AuthAPermissao->AuthAGruposLinksPermissao->AuthAGrupo->Behaviors->load('Containable');
		$this->AuthAPermissao->AuthAGruposLinksPermissao->AuthAGrupo->contain(
			'AuthASistema',
			'AuthAGruposLinksPermissao',
			'AuthAGruposLinksPermissao.AuthALink',
			'AuthAGruposLinksPermissao.AuthAPermissao'
		);
		$conditions = array(
			'AuthAGrupo.sistema_id' => $this->conditions['sistema_id']
		);
		$data = $this->AuthAPermissao->AuthAGruposLinksPermissao->AuthAGrupo->find('all',array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add($grupo_id = null) {
		if ($this->request->is('post')) {
			$this->AuthAPermissao->AuthAGruposLinksPermissao->create();
			$data = $this->request->data;
			// Carrega condicoes do sistema
			$data['AuthAGruposLinksPermissao']['grupo_id'] = $grupo_id;
			// Tenta salvar
			if ($this->AuthAPermissao->AuthAGruposLinksPermissao->save($data)) {
				$this->Session->setFlash(__('Permissao salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$AuthAMenus = $this->AuthAPermissao->AuthAGruposLinksPermissao->AuthALink->AuthAMenu->find(
				'list', 
					array(
						'fields'=>array('id'),
						'conditions'=>array('AuthAMenu.grupo_id'=>$grupo_id)
					)
			);
			$this->set('AuthALinks', $this->AuthAPermissao->AuthAGruposLinksPermissao->AuthALink->find(
				'list', 
					array(
						'fields'=>array('id','text'),
						'conditions' => array(
							'Link.menu_id' => $AuthAMenus
						)
					)
				)
			);
			$this->set('AuthAPermissoes', $this->AuthAPermissao->find('list', array('fields'=>array('id','nome'))));
		}
		$this->render('form');
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AuthAPermissao->AuthAGruposLinksPermissao->delete($id);
			$this->Session->setFlash(__('Permissao excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
