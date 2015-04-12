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
		$this->forms = [];
		$this->fields = [];

		$KDM = new SophworkDM($config);

		$nameField = $KDM->create('pp_field');
		$nameField->setFieldName('nimda-site-name');
		$nameField->setFieldType('text');
		$nameField->setFieldDomname('name');
		$nameField->setFieldDomid('name');
		$nameField->setFieldValue('');
		$nameField->setFieldPlaceholder('Site name');

		$descriptionField = $KDM->create('pp_field');
		$descriptionField->setFieldName('nimda-site-description');
		$descriptionField->setFieldType('text');
		$descriptionField->setFieldDomname('description');
		$descriptionField->setFieldDomid('description');
		$descriptionField->setFieldValue('');
		$descriptionField->setFieldPlaceholder('Description');

		$addressField = $KDM->create('pp_field');
		$addressField->setFieldName('nimda-site-address');
		$addressField->setFieldType('url');
		$addressField->setFieldDomname('address');
		$addressField->setFieldDomid('address');
		$addressField->setFieldValue(Sophwork::getUrl());
		$addressField->setFieldPlaceholder('Site name');

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

	public function renderView($page = null){
		// Get fields
		$nameField = $this->__getFields('nameField');
		$descriptionField = $this->__getFields('descriptionField');
		$addressField = $this->__getFields('addressField');

		$loader = new SophworkTELoader();
		$template = $loader->loadFromFile("template/". $page .".tpl");
		$KTE = new SophworkTEParser($template, [
			'h1' => 'Pinnackl Press',
			'h2' => 'Global configuration',
			'legend' => 'Site configuation',
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