<?php

namespace sophwork\app\controller;

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

class FormController{

	public function __construct(){

	}

	public function listenPost($POST){
		echo'<pre>';
		var_dump($POST);
		echo'</pre>';
	}

	public function listenGet($POST){

	}
}