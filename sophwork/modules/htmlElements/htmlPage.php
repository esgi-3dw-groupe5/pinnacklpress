<?php

namespace sophwork\modules\htmlElements;

class htmlPage extends htmlElement{
	
	protected $data;
	protected $layout;

	public function __construct($data){
		$this->data = json_decode($data);
		$this->layout = [];
	}

	public function createPage(){
		foreach ($this->data as $key => $value) {
			$line = new htmlElement('div');
			$line->set('class', 'line');
			foreach ($value as $key => $subValue) {
				foreach ($subValue as $key => $val) {
					$grid = new htmlElement('div');
					$grid->set('class', $val->gridClass);
					if($val->gridContent != 'null')
						$grid->set('text', $val->gridContent);
					$line->inject($grid);
				}
			}
			$this->layout[] = $line;
		}
		return $this;
	}

	public function render(){
		foreach ($this->layout as $key => $value) {
			$value->output();
		}
	}
}