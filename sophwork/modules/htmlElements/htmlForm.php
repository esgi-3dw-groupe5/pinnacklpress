<?php

namespace sophwork\modules\htmlElements;

use controller\utils\Users;

class htmlForm extends htmlElement{
	protected $data;
	protected $formName;
	protected $layout;
	
	public function __construct($data, $formName){
		$this->data = $data;
		$this->formName = $formName; 
	}

	public function createForm(){

		$layout = new htmlElement('div');
		$form = new htmlElement('form');

		$form->set('name',$this->formName);
		$form->set('method','POST');
		$form->set('action','controller/controllers/listener/listeners.php');
		$form->set('class','pinnackl-form pinnackl-form-stacked');

		$errorBox = new htmlElement('div');
		$errorBox->set('class', 'error animated shake unvisible');
		$form->inject($errorBox);

		Users::startSession();

		if($this->data != null) {
			foreach ($this->data as $key => $value) {

				$line = new htmlElement('label');
				$line->set('text', ucfirst($this->data[$key]['field_name']));
				$input = new htmlElement('input');
				$input->set('type',$this->data[$key]['field_type']);
				$input->set('id',$this->data[$key]['field_id']);
				$input->set('class','field pinnackl-input-1');
				$input->set('required','');
				$input->set('name',$this->data[$key]['field_name']);
				$input->set('placeholder', ucfirst($this->data[$key]['field_name']));
				if(isset($_SESSION['form']['submited'][$this->data[$key]['field_name']]))
					$input->set('value', $_SESSION['form']['submited'][$this->data[$key]['field_name']]);
				$line->inject($input);
				$form->inject($line);

				if($this->data[$key]['field_type'] == 'password' && array_key_exists('validator_rule', $this->data[$key])){
					$inputPwd = new htmlElement('input');
					$inputPwd->set('type','password');
					$inputPwd->set('id','validate_password');
					$inputPwd->set('class','field pinnackl-input-1');
					$inputPwd->set('required','');
					$inputPwd->set('name','validate_password');
					$inputPwd->set('placeholder','confirm password');
					$form->inject($inputPwd);
				}
			}
			$submit = new htmlElement('input');
			$submit->set('type','submit');
			$submit->set('name','__'.$this->formName);
			$submit->set('value','Submit');
			$submit->set('class','pinnackl-button pinnackl-button-primary');

			$form->inject($submit);
			$layout->inject($form);
			if(isset($_SESSION['form']['submited']))
				unset($_SESSION['form']['submited']);
			return $layout;
		} else {
			return $layout;
		}

	}
}