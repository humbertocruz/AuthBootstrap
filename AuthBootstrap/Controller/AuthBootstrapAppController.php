<?php
class AuthBootstrapAppController extends AppController {

	public $layout = 'bootstrap';

	public function beforeFilter() {
		$this->Auth->allow(array('authenticate'));
	}
	
}
