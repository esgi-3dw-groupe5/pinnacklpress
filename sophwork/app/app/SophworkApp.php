<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Main application class
 */

namespace sophwork\app\app;

use sophwork\core\Sophwork;
use sophwork\app\view\AppView;
use sophwork\app\model\AppModel;
use sophwork\app\controller\AppController;

class SophworkApp extends Sophwork{
	public $appName;
	public $config;
	public $appView;
	public $appModel;
	public $appController;

	protected $viewName;

	public function __construct(){
		parent::__construct();
		$this->config = parent::getConfig();

		$this->appName 			= "My app";
		$this->appView 			= new AppView();
		$this->appModel 		= new AppModel($this->config);
		$this->appController 	= new AppController($this->appModel);
	}
	
	public function __set($param, $value) {
		$this->$param = $value;
	}

	public function __get($param){
		return $this->$param;
	}

	public function setViewData($param, $value){
		$this->appView->__set($param, $value);
	}

	public function callView($name = null){
		if( $name !== null )
			$this->viewName = $name;
		
		$this->appView->renderView($this->viewName);
	}
}