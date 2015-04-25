<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Main controller class
 */

namespace sophwork\app\controller;

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
	// KTE
use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

class AppController extends SophworkApp{
	protected $action;
	// FIXME : Get all these param dynamicaly
	protected $page;
	protected $article;

	protected $loader;
	protected $template;
	protected $KTE;
	protected $data;

	public $appModel;
	protected $KDM;

	public function __construct($appModel = null){
		// FIXME : Get all these param dynamicaly
		$this->page 	= Sophwork::getParam('p','index');
		$this->article 	= Sophwork::getParam('a','');
		
		$this->appModel = $appModel;

		$action = $this->setConfigAction($_POST);
		$this->sendConfigAction($action, $_POST);

		if(!Sophwork::getConfig()){
			if($this->page == 'index')
				Sophwork::redirect('config');
			// use KTE to render the template
			$this->data = [
				'title' =>  'Setup config file',
				'h1' =>  'Setup config file',
				'header' =>  'Setup config file',
				'base' => 'template/css/base/base.css',
				'forms' => 'template/css/forms/forms.css',
				'buttons' => 'template/css/buttons/buttons.css',
			];
			$this->callView();
		}
		else{
			if($this->page == 'config')
				Sophwork::redirect();
		}

		$this->KDM = new SophworkDM(Sophwork::getConfig());
	}

	public function __get($param){
		if(isset($this->$param))
			return $this->$param;
		return false;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function getDataFromModel(){
		return $this->appModel->data;
	}

	public function setConfigAction($POST){
		if(array_key_exists('db_submit',$POST))
    		return $this->action = 'db_submit';
	}

	public function sendConfigAction($action,$POST){
		if ($action == 'db_submit'){
			Sophwork::setConfig($POST);
			Sophwork::redirect();
		}
	}

	public function callView($name = null){
			$this->loader = new SophworkTELoader();
			$this->template = $this->loader->loadFromFile("template/".$this->page.".tpl");
			if(!is_null($name))
				$this->template = $this->loader->loadFromFile("template/".$name.".tpl");
			$this->KTE = new SophworkTEParser($this->template, $this->data);
			echo $this->KTE->parseTemplate();
	}
}