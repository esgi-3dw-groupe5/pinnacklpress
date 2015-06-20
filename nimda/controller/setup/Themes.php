<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Themes extends \sophwork\app\controller\AppController{
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
		$fields = $KDM->create('pp_option');
		
		$themeField = $KDM->create('pp_field');
			$themeField->setFieldName('nimda-site-theme');
			$themeField->setFieldType('text');
			$themeField->setFieldDomname('theme');
			$themeField->setFieldDomid('theme');
				$fields->findOptionName('theme');
			$themeField->setFieldValue($fields->getOptionValue()[0]);
			$themeField->setFieldPlaceholder('Theme');

		$this->__setFields('themeField',$themeField);

		$fields->findOptionName('sidebar');
		$sidebar = $fields->getOptionValue()[0];

		// Get fields
		$themeField = $this->__getFields('themeField');

		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Theme configuration');
		$this->setViewData('legend1', 'Theme name');
		$this->setViewData('legend2', 'Theme Settings');
		// input-1
		$this->setViewData('label_1', $themeField->getFieldPlaceholder());
		$this->setViewData('input_1', $themeField->getFieldDomname());
		$this->setViewData('type_1', $themeField->getFieldType());
		$this->setViewData('value_1', $themeField->getFieldValue());
		$this->setViewData('sidebar', $sidebar);

		$this->callView($page, 'nimda/');
	}
}