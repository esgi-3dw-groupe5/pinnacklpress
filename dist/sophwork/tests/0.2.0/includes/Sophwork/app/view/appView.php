<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Main view class
 */

namespace sophwork\app\view;

use sophwork\app\app\SophworkApp;

class AppView extends SophworkApp{

	private $viewData = [];

	public function __construct() {

	}

	public function __set($param, $value) {
		$this->viewData[$param] = $value;
	}
	
	public function __get($param) {
		if (array_key_exists($param, $this->viewData)) {
			return $this->viewData[$param];
		}

		$trace = debug_backtrace();
		trigger_error(
		'Undefined property via __get(): ' . $param .
		' in ' . $trace[0]['file'] .
		' on line ' . $trace[0]['line'],
		E_USER_NOTICE);
		return null;
	}

	public function renderView($template){
		include(dirname(dirname(__FILE__)) . '/..' .'/../template/'.$template.'.tpl');
	}

	public function printOut($value){
		if(!isset($this->viewData[$value])){
			echo "";
		}
		else{
			echo htmlspecialchars($this->viewData[$value]);
		}
	}
}