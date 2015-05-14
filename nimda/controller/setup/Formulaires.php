<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use controller\form\Form;


class Formulaires extends \sophwork\app\controller\AppController{
	public $config;
	protected $forms;
	protected $fields;
	protected $form;

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

		// $loader = new SophworkTELoader();
		// $template = $loader->loadFromFile("template/". $page .".tpl");
		// $KTE = new SophworkTEParser($template, [
		// 	'h1' => 'Formulaire',
		// 	'h2' => 'Creation d\'un formulaire',
			
		// ]);
		// print $KTE->parseTemplate();
		$KDM = new SophworkDM($this->config);
		$action = Sophwork::getParam('a','');

		if($action == 'edit'){
			$page = 'form-edit';
			$formName = Sophwork::getParam('e','');	

			$form = new Form;
			$arrayForm = $form->getForm($formName);
			
			$plop = [];
			foreach ($arrayForm as $ke => $v) {
				foreach ($arrayForm[$ke] as $k => $val) {
						$plop[$k][] = $val;					
				}	
			}
			//var_dump($plop);

			$this->setViewData('form_name',$formName);
			$this->setViewData('form', $plop, 'field_id');
			$this->setViewData('form', $plop, 'field_name');
			$this->setViewData('form', $plop, 'field_type');
			$this->setViewData('form', $plop, 'validator_rule');

			$this->setViewData('h1', 'Edit form');

			$this->callView($page, 'nimda/');
		}else{
			$options = $KDM->create('pp_option');
			$options->findOptionName('siteurl');
			$siteurl = $options->getOptionValue()[0];
	
			$this->setViewData('siteurl', $siteurl);
	
			$forms = $KDM->create('pp_form');
			$forms->find();

			$this->setViewData('h1', 'Formulaire');
			$this->setViewData('h2-create', 'Create form');
			$this->setViewData('h2-list', 'Forms list');
			$this->setViewData('forms', $forms->getData(), 'form_id');
			$this->setViewData('forms', $forms->getData(), 'form_name');
	
			$this->callView($page, 'nimda/');
		}
	}
}