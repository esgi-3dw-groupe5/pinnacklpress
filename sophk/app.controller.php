<?php
interface test {

}

class AppController extends SophKApp{
	protected $page;
	protected $article;

	public $appModel;

	public function __construct($appModel = null){
		$this->page 	= SophK::getParam('p','index');
		$this->article 	= SophK::getParam('a','');
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