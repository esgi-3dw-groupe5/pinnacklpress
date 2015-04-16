<?php

namespace controller\form;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
use controller\form\Field;
use controller\form\Validator;

class Form{

	protected $KDM;
	protected $fields = [];

/*	public function __construct($name,$config){
		$this->KDM = new SophworkDM($config);
		// Create a new form object by the form unique name
		$form = $this->KDM->create('pp_form');
		$form->findOne($name);
		$data = $form->getData();

		// Create a new form relationship table
		$rs = $this->KDM->create('pp_form_rs');
		// Search in the rs table for the form link to field
		$rs->findFormId($data['form_id']);
		$data = $rs->getData();

		// Create a new field object wich math to the created form
		$field = $this->KDM->create('pp_field');
		foreach ($data['field_id'] as $key => $value) {
			$field->findFieldId($data['field_id'][$key]);
			$fields[] = $field->getData();
		}
	}*/

	public function getForm($name,$config){
		$this->KDM = new SophworkDM($config);
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
		for($i = 0 ; $i < count($data['field_id']) ; $i++){
			$rsField->findFieldId($data['field_id'][$i]);
			$dataField = $rsField->getData();
			array_push($this->fields, $dataField['validator_id'][0]);
		}
		$validatorArray = $validator->getRules($this->fields,$this->KDM);
		
		var_dump($fieldArray);
		var_dump($validatorArray);
	}
}