<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use controller\form\Form;


class Formulaires extends \sophwork\app\view\AppView{
	public $config;
	protected $forms;
	protected $fields;
	protected $form;

	public function __construct($config = null){
		$this->forms = [];
		$this->fields = [];

		$KDM = new SophworkDM($config);
		// $forms = $KDM->create('pp_form');
		// $forms->find();
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

	public function renderView($page){

		$loader = new SophworkTELoader();
		$template = $loader->loadFromFile("template/". $page .".tpl");
		$KTE = new SophworkTEParser($template, [
			'h1' => 'Formulaire',
			'h2' => 'Creation d\'un formulaire',
			
		]);
		print $KTE->parseTemplate();
	}
}