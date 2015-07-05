<?php

namespace controller\form;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
use controller\form\Field;
use controller\form\Validator;

class Form extends \sophwork\app\controller\AppController{

	protected $KDM;
	protected $fields = [];


	public function __construct(){
		parent::__construct();
	}

	public function getForm($name){
		$this->KDM = new SophworkDM($this->config);
		$field = new Field();
		$validator = new Validator();
		// Create a new form object by the form unique name
		$form = $this->KDM->create('pp_form');
		$form->findOne($name);
		$data = $form->getData();
		// Create a new form relationship table
		$rsForm = $this->KDM->create('pp_form_rs');
		// Search in the rs form table for the form link to field
		$rsForm->findFormId($data['form_id']);
		$data = $rsForm->getData();

		$fieldArray = $field->getFields($data['field_id'],$this->KDM);
		// Search in the rs field table for the field link to validator
		$rsField = $this->KDM->create('pp_field_rs');

		$field = 0;
		$validatorId = 0;
		for($i = 0 ; $i < count($data['field_id']) ; $i++){
			$rsField->findFieldId($data['field_id'][$i]);
			$dataField = $rsField->getData();
			
			for($j = 0 ; $j < count($dataField['validator_id']) ; $j++) {
				if($field !=  $dataField['field_id'][$j] && $validator != $dataField['validator_id'][$j]){
					$tempArray['field_id'] = $dataField['field_id'][$j];
					$tempArray['validator_id'] = $dataField['validator_id'][$j];
					$this->fields[] = $tempArray;
				}
				$field = $dataField['field_id'][$j];
				$validatorId = $dataField['validator_id'][$j];
			}			
		}
		$formArray = $validator->getRules($this->fields,$this->KDM,$fieldArray);

		return $formArray;
	}
}