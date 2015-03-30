<?php

namespace controller\form;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Form{

	protected $KDM;
	protected $fields = [];

	public function __construct($name,$config){
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
	}
}