<?php
/**
 * Created by PhpStorm.
 * User: humberto
 * Date: 13/01/14
 * Time: 10:15
 */

class AuthBsHelper extends AppHelper {

	public function brdate( $date = null ) {
		$date = new DateTime( $date );
		return $date->format( 'd/m/Y' );
	}

	public function hasPerm( $what = null, $perms = null ) {
		if (isset($perms[$this->params['controller']][$this->params['action']][$what])) return true;
		else return false;
	}
}
