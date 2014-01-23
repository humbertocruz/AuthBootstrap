<?php
class AuthBootstrapAppController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow(array('authenticate'));
	}
	
}
