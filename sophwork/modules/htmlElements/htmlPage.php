<?php

namespace sophwork\modules\htmlElements;
use controller\form\Form;
use sophwork\modules\htmlElements;

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
				// $img = new htmlElement('img');
				// $img->set('src', 'data/users/Syu93/Syu93.jpg');

				// $auteur = new htmlElement('div');
				// $auteur->set('class', 'auteur');
				// $auteur->set('text', 'auteur');
				// $auteur->inject($img);
				// $line->inject($auteur);
				foreach ($subValue as $key => $val) {
					$grid = new htmlElement('div');
					$grid->set('class', $val->gridClass);

					if($val->gridContent != 'null' && $val->gridModule != '[form]')
						$grid->set('text', $val->gridContent);
					elseif($val->gridContent != 'null' && $val->gridModule == '[form]'){
						$form = new Form;
						$form = $form->getForm($val->gridContent);
						$html = new HtmlForm($form,$val->gridContent);
						$layout = $html->createForm();
						$grid->set('text',$layout->attributes['text']);
					}
					$line->inject($grid);
				}

				// $hr = new htmlElement('hr');
				// $line->inject($hr);
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