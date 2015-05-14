<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.2
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
	// public $appName;
	public $config;
	public $appView;
	public $appModel;
	public $appController;

	protected $viewName;

	public function __construct(){
		parent::__construct();
		$this->config = Sophwork::getConfig();

		$this->appName 			 = "Pinnackl";
		$this->appView 			 = new AppView();
		$this->appView
			->viewData 			 = new \StdClass();
		//$this->appModel 		 = new AppModel($this->config);
		if(!($this instanceof AppController))
			$this->appController 	= new AppController($this->appModel);
	}
	
	public function __set($param, $value) {
		$this->$param = $value;
	}

	public function __get($param){
		return $this->$param;
	}

	public function setViewData($itemName, $values, $arrayKey = null){
		if(gettype($values) == 'string'){
			$this->appView
				->viewData->$itemName = $values;
		}
		
		$list = new \StdClass();
		if(gettype($values) == 'array' && !is_null($arrayKey)){
			if(isset($this->appView->viewData->$itemName)){
				$list = $this->appView->viewData->$itemName;
			}
			if(!is_null($values[$arrayKey])){
				foreach ($values[$arrayKey] as $key => $value) {
					$itemObj = new \StdClass();
					$subItemName = $itemName.$key;
					if(isset($this->appView->viewData->$itemName->$subItemName)){
						$itemObj = $this->appView->viewData->$itemName->$subItemName;
					}
					$itemObj->$arrayKey = $value;
					// add
					$list->$subItemName = $itemObj;
				}
				// add
				$this->appView->viewData->$itemName = $list;
			}
			else{
				$this->appView->viewData->$itemName = $list;
			}
		}
	}

	public function setRawData($itemName, $value){
		$this->appView->viewData->$itemName = $value;
	}

	public function callView($name = null, $path = null){
		if( !is_null($name) )
			$this->viewName = $name;
		$this->appView
			->renderView($this->viewName, $path);
	}
}
