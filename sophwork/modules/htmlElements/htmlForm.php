<?php

namespace sophwork\modules\htmlElements;

class htmlForm extends htmlElement{
	protected $data;
	protected $layout;
	
	public function __construct($data){
		$this->data = $data;
	}

	public function createForm(){
		//var_dump($)
		$layout = new htmlElement('div');
		foreach ($this->data as $key => $value) {
			$line = new htmlElement('div');
			$line->set('class','line');

			$input = new htmlElement('input');
			$input->set('type',$this->data[$key]['field_type']);
			//var_dump($this->data[$key]['field_type']);
			$layout->inject($input);
		}
		// $layout = new htmlElement('div');
		// foreach ($this->data as $key => $value) { // Foreach lines
		// 	$line = new htmlElement('div');
		// 	$line->set('class', 'line');
		// 	foreach ($value->line as $key => $subValue) { // Foreach sections
		// 		$section = new htmlElement('div');
		// 		$section->set('class', $subValue->gridClass);
		// 		if($subValue->gridContent != 'null')
		// 			$section->set('text', $subValue->gridContent);
		// 		$line->inject($section);
		// 	}
		// 	$layout->inject($line);
		// }
		return $layout;
	}
}