<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

class Pages extends \sophwork\app\controller\AppController{
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

	public function renderView($page = null){
		$KDM = new SophworkDM($this->config);
		$options = $KDM->create('pp_option');
		$options->findOptionName('siteurl');
		$siteurl = $options->getOptionValue()[0];

		$this->setViewData('siteurl', $siteurl);

		$pages = $KDM->create('pp_page');
		$pages->find();
		
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Pages configuration');
		$this->setViewData('pages', $pages->getData(), 'page_id');
		$this->setViewData('pages', $pages->getData(), 'page_tag');
		$this->setViewData('pages', $pages->getData(), 'page_name');
		$this->setViewData('pages', $pages->getData(), 'page_order');
		$this->setViewData('pages', $pages->getData(), 'page_display');
		$this->setViewData('pages', $pages->getData(), 'page_active');
		$this->setViewData('pages', $pages->getData(), 'page_type');

		$this->callView($page, 'nimda/');
	}
}