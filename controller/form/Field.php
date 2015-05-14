<?php

namespace controller\form;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
use controller\form\Validator;

class Field extends Validator{



	public function __construct(){}

	public function getFields($idFields,$kdm){
		$field = $kdm->create('pp_field');
		foreach ($idFields as $key => $value) {
			$field->findFieldId($idFields[$key]);
			$arrayField = $field->getData();
			foreach ($arrayField as $key => $value) {
				$arrayField[$key]=$value[0];
			}
			$fields[] = $arrayField;
		}
		return $fields;
	}



}