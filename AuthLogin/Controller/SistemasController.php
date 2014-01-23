<?php
App::uses('Controller', 'Controller');
class SistemasController extends AuthLoginAppController {
	var $uses = array('AuthLogin.Sistema','AuthLogin.GruposUsuario');
	
	public function index() {
		$usuario = $this->Auth->user();

		$grupos_usuarios = $this->GruposUsuario->find('all', array(
			'fields'=>array('Grupo.sistema_id'),
			'conditions' => array(
				'Usuario.id' => $usuario['id']
			)
		));
		$sistemas_ids = array();
		foreach($grupos_usuarios as $grupo) {
			array_push($sistemas_ids, $grupo['Grupo']['sistema_id']);
		}
		
		$sistemas = $this->Sistema->find('all', array(
			'conditions' => array(
				'Sistema.id' => $sistemas_ids
			)
		));
		$this->set('sistemas',$sistemas);
		$this->set('usuario',$usuario);

	}
}
