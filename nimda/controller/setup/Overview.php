<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

class Overview extends \sophwork\app\view\AppView{
	public $config;
	protected $forms;
	protected $fields;

	public function __construct($config = null){
		parent::__construct();
		$this->forms = [];
		$this->fields = [];

		$KDM = new SophworkDM($config);
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

		$this->__setFields('nameField',$nameField);
		$this->__setFields('descriptionField',$descriptionField);
		$this->__setFields('addressField',$addressField);
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
		// Get fields
		$nameField = $this->__getFields('nameField');
		$descriptionField = $this->__getFields('descriptionField');
		$addressField = $this->__getFields('addressField');

		$loader = new SophworkTELoader();
		$template = $loader->loadFromFile("template/". $page .".tpl");
		$KTE = new SophworkTEParser($template, [
			'h1' => 'Pinnackl Press',
			'h2' => 'Global configuration',
			'legend' => 'Site Setup',
			// input-1
			'label_1' => $nameField->getFieldPlaceholder(),
			'input_1' => $nameField->getFieldDomname(),
			'type_1' => $nameField->getFieldType(),
			'value_1' => $nameField->getFieldValue(),
			// input-2
			'label_2' => $descriptionField->getFieldPlaceholder(),
			'input_2' => $descriptionField->getFieldDomname(),
			'type_2' => $descriptionField->getFieldType(),
			'value_2' => $descriptionField->getFieldValue(),
			// input-3
			'label_3' => $addressField->getFieldPlaceholder(),
			'input_3' => $addressField->getFieldDomname(),
			'type_3' => $addressField->getFieldType(),
			'value_3' => $addressField->getFieldValue(),
		]);
		print $KTE->parseTemplate();
	}
}