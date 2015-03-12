<?php

class SophKApp extends Sophk{
	public $appName;
	public $appView;
	public $appModel;
	public $appController;

	protected $viewName;

	public function __construct(){
		parent::__construct();
		$this->setHtaccess("SophK");

		$this->appName 		= "My app";
		$this->appView 		= new AppView();
		$this->appModel 	= new AppModel();
		$this->appController = new AppController($this->appModel);

		$this->setViewData('h1', 'Setup config file');
		$config = parent::getConfig();
		if(!$config){
			$this->callView('config');
			// die();
		}
	}
	
	public function __set($param, $value) {
		$this->viewData[$param] = $value;
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