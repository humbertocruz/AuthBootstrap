<?php
App::uses('Controller', 'Controller');

class SistemasController extends ServerAppController {
	
	
	public $uses = array('Server.Usuario','Server.Grupo','Server.Menu','Server.Sistema');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('formatedName','Sistemas');
	}

	public function view() {
		$this->Sistema->Grupo->Behaviors->load('Containable');
		$this->Sistema->Grupo->contain('Sistema','GruposUsuario');

		$conditions = array(
			'GruposUsuario.usuario_id' => $this->Auth->user()['id']
		);
		$Grupos = $this->Sistema->Grupo->GruposUsuario->find('list', array('fields'=>array('GruposUsuario.grupo_id','GruposUsuario.grupo_id'),'conditions'=>$conditions));
		$Grupos = explode(',', implode(',', $Grupos));
		$conditions = array(
			'Grupo.id IN' => $Grupos
		);

		$Sistemas = $this->Sistema->Grupo->find('all', array('conditions'));
		$this->set('Sistemas',$Sistemas);
	}

}