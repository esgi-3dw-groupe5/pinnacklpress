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

	// KTE
use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

class AppController extends SophworkApp{
	protected $action;
	protected $page;
	protected $article;

	public $appModel;

	public function __construct($appModel = null){
		$this->page 	= Sophwork::getParam('p','index');
		$this->article 	= Sophwork::getParam('a','');
		$this->appModel = $appModel;
		
		// use KTE to render the template
		$loader = new SophworkTELoader();
		// // if(!$app->config){
		if(!Sophwork::getConfig()){
			if($this->page == 'index')
				Sophwork::redirect('config');
			$template = $loader->loadFromFile("template/".$this->page.".tpl");
			$KTE = new SophworkTEParser($template,$data = [
				'title' =>  'Setup config file',
				'h1' =>  'Setup config file',
				'header' =>  'Setup config file',
				'base' => 'template/css/base/base.css',
				'forms' => 'template/css/forms/forms.css',
				'buttons' => 'template/css/buttons/buttons.css',
			]);
			echo $KTE->parseTemplate();
		}
		else{
			if($this->page == 'config')
				Sophwork::redirect();
			// $template = $loader->loadFromFile("template/".$this->page.".tpl");
		// 	$KTE = new SophworkTEParser($template,$data = [
		// 		'title' =>  'My first SophK App',
		// 		'menu' =>  ['menu1','menu2','index','menu4','menu5', ],
		// 		'active' => ['active'],
		// 		'my element' =>  'articles',
		// 		'h1' =>  'Hello World',
		// 		'footer' =>  'Here is my footer',
		// 	]);
		// 	echo $KTE->parseTemplate();
		// 	exit;
		}
	}

	public function __get($param){
		if(isset($this->$param))
			return $this->$param;

		return false;
	}

	public function __set($param, $value){

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
			var_dump($POST);
			$this->displayErr = Sophwork::setConfig($POST);
			Sophwork::redirect();
		}
		
		return $this->displayErr;
	}
}