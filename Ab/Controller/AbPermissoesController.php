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

class AbPermissoesController extends AbAppController {

	public function index() {
		$this->AbPermissao->AbGruposLinksPermissao->AbGrupo->Behaviors->load('Containable');
		$this->AbPermissao->AbGruposLinksPermissao->AbGrupo->contain(
			'AbSistema',
			'AbGruposLinksPermissao',
			'AGruposLinksPermissao.AbLink',
			'AbGruposLinksPermissao.AbPermissao'
		);
		$conditions = array(
			'AbGrupo.sistema_id' => $this->conditions['sistema_id']
		);
		$data = $this->AbPermissao->AbGruposLinksPermissao->AbGrupo->find('all',array('conditions'=>$conditions));
		$this->set('data', $data);
	}

	public function add($grupo_id = null) {
		if ($this->request->is('post')) {
			$this->AbPermissao->AbGruposLinksPermissao->create();
			$data = $this->request->data;
			// Carrega condicoes do sistema
			$data['AbGruposLinksPermissao']['grupo_id'] = $grupo_id;
			// Tenta salvar
			if ($this->AbPermissao->AbGruposLinksPermissao->save($data)) {
				$this->Session->setFlash(__('Permissao salvo com sucesso.'));
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash(__('Não foi possível gravar.'));
            }
		} else {
			$AbMenus = $this->AbPermissao->AbGruposLinksPermissao->AbLink->AbMenu->find(
				'list', 
					array(
						'fields'=>array('id'),
						'conditions'=>array('AbMenu.grupo_id'=>$grupo_id)
					)
			);
			$this->set('AbLinks', $this->AbPermissao->AbGruposLinksPermissao->AbLink->find(
				'list', 
					array(
						'fields'=>array('id','text'),
						'conditions' => array(
							'AbLink.menu_id' => $AbMenus
						)
					)
				)
			);
			$this->set('AbPermissoes', $this->AbPermissao->find('list', array('fields'=>array('id','nome'))));
		}
		$this->render('form');
	}

	function delete($id = null) {
		if ($this->request->is('post')) {
			$this->AbPermissao->AbGruposLinksPermissao->delete($id);
			$this->Session->setFlash(__('Permissao excluído com sucesso.'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
