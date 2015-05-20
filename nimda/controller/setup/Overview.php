<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Overview extends \sophwork\app\controller\AppController{
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

		$nameField = $KDM->create('pp_field');
			$nameField->setFieldName('nimda-site-sitename');
			$nameField->setFieldType('text');
			$nameField->setFieldDomname('sitename');
			$nameField->setFieldDomid('sitename');
				$fields->findOptionName('sitename');
			$nameField->setFieldValue($fields->getOptionValue()[0]);
			$nameField->setFieldPlaceholder('Site name');

		$descriptionField = $KDM->create('pp_field');
			$descriptionField->setFieldName('nimda-site-sitedescription');
			$descriptionField->setFieldType('text');
			$descriptionField->setFieldDomname('sitedescription');
			$descriptionField->setFieldDomid('sitedescription');
				$fields->findOptionName('sitedescription');
			$descriptionField->setFieldValue($fields->getOptionValue()[0]);
			$descriptionField->setFieldPlaceholder('Description');

		$addressField = $KDM->create('pp_field');
			$addressField->setFieldName('nimda-site-siteurl');
			$addressField->setFieldType('url');
			$addressField->setFieldDomname('siteurl');
			$addressField->setFieldDomid('siteurl');
			$addressField->setFieldValue(Sophwork::getUrl()); // Get the URL what ever is set in the database
			$addressField->setFieldPlaceholder('Site address');
		
		$themeField = $KDM->create('pp_field');
			$themeField->setFieldName('nimda-site-theme');
			$themeField->setFieldType('text');
			$themeField->setFieldDomname('theme');
			$themeField->setFieldDomid('theme');
				$fields->findOptionName('theme');
			$themeField->setFieldValue($fields->getOptionValue()[0]);
			$themeField->setFieldPlaceholder('Theme');
		$this->__setFields('nameField',$nameField);
		$this->__setFields('descriptionField',$descriptionField);
		$this->__setFields('addressField',$addressField);
		$this->__setFields('themeField',$themeField);

		// Get fields
		$nameField = $this->__getFields('nameField');
		$descriptionField = $this->__getFields('descriptionField');
		$addressField = $this->__getFields('addressField');
		$themeField = $this->__getFields('themeField');

		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Global configuration');
		$this->setViewData('legend1', 'Site configuation');
		$this->setViewData('legend2', 'Theme configuation');
		// input-1
		$this->setViewData('label_1', $nameField->getFieldPlaceholder());
		$this->setViewData('input_1', $nameField->getFieldDomname());
		$this->setViewData('type_1', $nameField->getFieldType());
		$this->setViewData('value_1', $nameField->getFieldValue());
		// input-2
		$this->setViewData('label_2', $descriptionField->getFieldPlaceholder());
		$this->setViewData('input_2', $descriptionField->getFieldDomname());
		$this->setViewData('type_2', $descriptionField->getFieldType());
		$this->setViewData('value_2', $descriptionField->getFieldValue());
		// input-3
		$this->setViewData('label_3', $addressField->getFieldPlaceholder());
		$this->setViewData('input_3', $addressField->getFieldDomname());
		$this->setViewData('type_3', $addressField->getFieldType());
		$this->setViewData('value_3', $addressField->getFieldValue());
		// input-3
		$this->setViewData('label_4', $themeField->getFieldPlaceholder());
		$this->setViewData('input_4', $themeField->getFieldDomname());
		$this->setViewData('type_4', $themeField->getFieldType());
		$this->setViewData('value_4', $themeField->getFieldValue());

		$this->callView($page, 'nimda/');
	}
}