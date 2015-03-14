<?php

class SophKApp extends Sophk{
	public $appName;
	public $appView;
	public $appModel;
	public $appController;

	protected $viewName;

	protected $loader;
	protected $template;
	public $KTE;

	public function __construct(){
		parent::__construct();
		$this->setHtaccess("SophK");

		$this->appName 			= "My app";
		$this->appView 			= new AppView(); // use KTE instead of the view ?
		$this->loader 			= new SophKTELoader();
		$this->appModel 		= new AppModel();
		$this->appController 	= new AppController($this->appModel);

		$this->setViewData('h1', 'Setup config file');
		$config = parent::getConfig();
		if(!$config){
			// $this->callView('config');
			$template = $this->loader->loadFromFile("template/config.tpl");
			$this->KTE = new SophKTEParser($template,$data = [
				'title' =>  'Setup config file',
				'h1' =>  'Setup config file',
				'header' =>  'Setup config file',
			]);
		}
		else{
			$template = $this->loader->loadFromFile("template/index.tpl");
			$this->KTE = new SophKTEParser($template,$data = [
				'title' =>  'My first SophK App',
				'menu' =>  ['menu1','menu2','menu3','menu4','menu5', ],
				'my element' =>  'articles',
				'h1' =>  'Hello World',
				'footer' =>  'Here is my footer',
			]);
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