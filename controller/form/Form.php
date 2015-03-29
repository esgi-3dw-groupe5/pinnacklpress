<?php

namespace controller\form;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Form{

	protected $KDM;
	protected $fields = [];

	public function __construct($name,$config){
		$this->KDM = new SophworkDM($config);
		$form = $this->KDM->create('pp_form');
		$form->findOne('inscription');
		$data = $form->getData();
		var_dump($data);

		foreach ($data as $key => $value) {
			$field = $this->KDM->create('pp_form_rs');
			$field->find($data['form_id']);
			$this->fields[] = $field;
		}
		var_dump($this->fields);
		
	}

	public function createField($name){
		$field = $KDM->create('pp_field');
		$field->findOne($name);
		var_dump($field);
	}	




}