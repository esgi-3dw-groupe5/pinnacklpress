<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Main controller class
 */

namespace sophwork\app\controller;

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

class AppController extends SophworkApp{
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
}