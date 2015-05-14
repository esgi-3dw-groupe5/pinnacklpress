<?php

namespace sophwork\modules\handlers\requests;

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

class Request{

	public function __construct(){

	}

	public static function listenPost(){
		if(count($_POST) < 1)
			return false;
		// echo'<pre>';
		// var_dump($_SERVER['REQUEST_METHOD']);
		// var_dump($_SERVER['REQUEST_URI']);
		// var_dump($_SERVER['SERVER_PROTOCOL']);
		// var_dump(getallheaders());
		// echo'</pre>';
		return true;
	}

	public static function listenGet(){
		if(count($_GET) < 1)
			return false;
		return true;
	}

	public static function isSubmit($form){
		if(array_key_exists($form, $_POST))
			return true;
		if(array_key_exists($form, $_GET))
			return true;
		return false;
	}
}