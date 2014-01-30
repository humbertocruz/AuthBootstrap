<?php
class PagesController extends AdminAppController {

	public function display($page) {
		$this->render($page);
	}

}