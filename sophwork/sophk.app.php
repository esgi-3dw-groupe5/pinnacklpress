<?php

class SophworkApp extends Sophwork{
	public $appName;
	public $config;
	public $appView;
	public $appModel;
	public $appController;

	protected $viewName;

	protected $loader;
	protected $template;
	public $KTE;

	public function __construct(){
		parent::__construct();

		$this->appName 			= "My app";
		$this->appView 			= new AppView(); // use KTE instead of the view ?
		$this->loader 			= new SophworkTELoader();
		$this->appModel 		= new AppModel();
		$this->appController 	= new AppController($this->appModel);

		$this->setViewData('h1', 'Setup config file');
		$this->config = parent::getConfig();

		if(!$this->config){
			if($this->appController->page == 'index')
				header('Location: http://127.0.0.1/pinnacklpress/config');
			$template = $this->loader->loadFromFile("template/".$this->appController->page.".tpl");
			$this->KTE = new SophworkTEParser($template,$data = [
				'title' =>  'Setup config file',
				'h1' =>  'Setup config file',
				'header' =>  'Setup config file',
				'base' => 'template/css/base/base.css',
				'forms' => 'template/css/forms/forms.css',
				'buttons' => 'template/css/buttons/buttons.css',
			]);
		}
		else{
			if($this->appController->page == 'config')
				header('Location: http://127.0.0.1/pinnacklpress/');
			$template = $this->loader->loadFromFile("template/".$this->appController->page.".tpl");
			$this->KTE = new SophworkTEParser($template,$data = [
				'title' =>  'My first SophK App',
				'menu' =>  ['menu1','menu2','index','menu4','menu5', ],
				'active' => ['active'],
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