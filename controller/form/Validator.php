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

	public function getRules($idValidators,$kdm,$formArray){
		$validator = $kdm->create('pp_validator');

		foreach ($idValidators as $key => $value) {
			$idRsField = $value['field_id'];
			$rule = $value['validator_id'];

			foreach ($formArray as $key1 => $value) {
				$idField = $value['field_id'];
				if($idRsField == $idField[0]){
					$validator->findValidatorId($rule);
					$validators = $validator->getData();
					$formArray[$key1]['validator_rule'][] = $validators['validator_rule'][0];
				}
			}
		}
		return $formArray;

	}

	public function validateForm($form,$POST){
		$rule = new Rule();
		foreach ($form as $key => $value) {
			if(array_key_exists('validator_rule', $value)){
				$validator_rule = $value['validator_rule'][0];
				$fieldName = $value['field_name'][0];
				$fieldValue = $POST[$fieldName];
				$rule->$validator_rule($fieldValue);
			}
		}
		return $rule;
	}

	public function __get($param){
		return $this->param;
	}







}