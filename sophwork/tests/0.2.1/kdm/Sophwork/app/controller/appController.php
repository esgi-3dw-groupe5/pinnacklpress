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

class AppController extends SophworkApp{
	protected $action;
	protected $page;
	protected $article;

	public $appModel;

	public function __construct($appModel = null){
		$this->page 	= Sophwork::getParam('p','index');
		$this->article 	= Sophwork::getParam('a','');
		$this->appModel = $appModel;
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
			$this->displayErr = Sophwork::setConfig($POST);
			Sophwork::redirect();
		}
		
		return $this->displayErr;
	}
}