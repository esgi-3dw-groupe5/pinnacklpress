<?php 

namespace controller\form;

use controller\form\Rule;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Validator{

	protected $form;
	protected $rule;
	protected $KDM;

	public function __construct(){

	}

	public function getRules($idValidators,$kdm){
		$validator = $kdm->create('pp_validator');
		foreach ($idValidators as $key => $value) {
			$validator->findValidatorId($idValidators[$key]);
			$validators[] = $validator->getData();
		}
		return $validators;
	}

	public function validateForm($form){
		$this->form = $form;
		$this->rule = new Rule;
	}

	public function __get($param){
		return $this->param;
	}







}