<?php
class AuthLoginAppController extends AppController {

	public $layout = 'AuthBootstrap.bootstrap';

	public function beforeFilter() {

		$this->Auth->allow('login','logout');

	}
	
}
