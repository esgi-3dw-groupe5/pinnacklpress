<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Main view class
 */

namespace sophwork\app\view;

use sophwork\app\app\SophworkApp;

class AppView extends SophworkApp{

	private static $viewData;

	public function __construct() {

	}

	public function __set($param, $value) {
		$this->$param = $value;
	}
	
	public function __get($param) {
		return $this->$param;
	}

	public function renderView($template){
		include(dirname(dirname(__FILE__)) . '/..' .'/../template/'.$template.'.tpl');
	}

	protected static $modifiers = [
		'S' => 'htmlspecialchars',
		'U' => 'strtoupper',
		'L' => 'strtolower',
		'FU' => 'ucfirst',
		'FL' => 'lcfirst',
	];

	public static function e($value, $modifier = 'S'){
		$method = self::$modifiers[$modifier];
		echo $method($value);
	}
}