<?php 

namespace controller\form;

use controller\form\Rule;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Validator{

	protected $form;
	protected $rule;
	protected $KDM;

	public function __construct($config){
		$this->rule = [];
		$this->KDM = new SophworkDM($config);
	}

	public function validateForm($form){
		$this->form = $form;
		$this->rule = new Rule;
	}

	public function __get($param){
		return $this->param;
	}







}