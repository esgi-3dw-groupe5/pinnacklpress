<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

use nimda\controller\access\Controller;

class Overview extends Controller{
	public $config;
	protected $forms;
	protected $fields;

	public function __construct($config = null){
		parent::__construct();
		$this->config = $config;
		$this->forms = [];
		$this->fields = [];
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function __getForms($param){
		return $this->forms[$param];
	}

	public function __setForms($param, $value){
		$this->forms[$param] = $value;
	}

	public function __getFields($param){
		return $this->fields[$param];
	}
 
	public function __setFields($param, $value){
		$this->fields[$param] = $value;
	}

	public function renderView($page = null, $path = null){
		$KDM = new SophworkDM($this->config);
		$action = Sophwork::getParam('a', '');
		$edit = Sophwork::getParam('e', '');
		
		$options = $KDM->create('pp_option');
		$options->findOptionName('siteurl');
		$siteurl = $options->getOptionValue()[0];

		$pages = $KDM->create('pp_page');
		$contents = $KDM->create('pp_pagemeta');
		
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Overview');
			
		$this->callView($page, 'nimda/');
	}
}