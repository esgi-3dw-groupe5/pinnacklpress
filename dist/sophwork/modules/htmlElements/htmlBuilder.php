<?php

namespace sophwork\modules\htmlElements;

class htmlBuilder extends htmlElement{
	protected $data;
	protected $layout;
	
	public function __construct($data){
		$this->layout = [];
		$this->data = json_decode($data);
	}

	public function createBuilder(){
		// $layout = new htmlElement('div');
		if($this->data != null) {
			foreach ($this->data as $key => $value) { // Foreach lines
				$i = 1;
				$line = new htmlElement('div');
				$line->set('id', $i);
				$line->set('class', 'builder-line');
				
				$header = new htmlElement('header');
				$icone = new htmlElement('i');
				$icone->set('class', 'close');
				$icone->set('data', $i);
				
				$header->inject($icone);
				$line->inject($header);

				foreach ($value->line as $key => $subValue) { // Foreach sections
					$section = new htmlElement('div');
					$section->set('class', 'builder-section ' . str_replace('grid', 'gd', $subValue->gridClass));
					$section->set('data-grid', $subValue->gridClass);
					$section->set('data-module', $subValue->gridModule);

					if($subValue->gridModule != 'null')	$section->set('text', $subValue->gridModule);
					else $section->set('text', 'Section ' . $i);

					$section->set('data-content', $subValue->gridContent);
					$line->inject($section);
					$i++;
				}
				$this->layout[] = $line;
			}
			return $this;
		} else {
			return $this;
		}
	}

	public function createPage(){
		$this->layout = new htmlElement('div');
		foreach ($this->data as $key => $value) { // Foreach lines
			$line = new htmlElement('div');
			$line->set('class', 'line');
			foreach ($value->line as $key => $subValue) { // Foreach sections
				$section = new htmlElement('div');
				$section->set('class', $subValue->gridClass);
				if($subValue->gridContent != 'null')
					$section->set('text', $subValue->gridContent);
				$line->inject($section);
			}
			$this->layout->inject($line);
		}
		return $this;
	}

	public function render(){
		foreach ($this->layout as $key => $value) {
			$value->output();
		}
	}
}