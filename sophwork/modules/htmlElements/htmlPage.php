<?php

namespace sophwork\modules\htmlElements;
use sophwork\core\Sophwork;
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
		if($this->data != null) {
			foreach ($this->data as $key => $value) {
				$line = new htmlElement('div');
				$line->set('class', 'line');
				foreach ($value as $key => $subValue) {
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
				}
				$this->layout[] = $line;
			}
			return $this;
		}else {
			return $this;
		}
	}

	public function createPostList(){
		if($this->data != null) {
			$line = new htmlElement('div');
			$line->set('class', 'line');
			foreach ($this->data as $key => $value) {
				$card = new htmlElement('div');
				$card->set('class', 'grid-1_3 articles');
				foreach ($value as $key => $subValue) {
					$authorLink = new htmlElement('a');
					$authorLink->set('href', Sophwork::getUrl('user/Syu93'));
					
					$img = new htmlElement('img');
					$img->set('src', Sophwork::getUrl('data/users/Syu93/Syu93.jpg'));
					
					$authorLink->inject($img);

					$auteur = new htmlElement('div');
					$auteur->set('class', 'auteur');
					$auteur->set('text', 'Syu93'); // FIXME: Get the real author
					$auteur->inject($authorLink);
					$card->inject($auteur);

					foreach ($subValue as $key => $val) {
						$articleLink = new htmlElement('a');
						$articleLink->set('href', Sophwork::getUrl('mon-premier-article'));

						$grid = new htmlElement('div');
						$grid->set('class', $val->gridClass . ' preview');

						if($val->gridContent != 'null' && $val->gridModule != '[form]')
							$grid->set('text', substr($val->gridContent, 0, 200) . ' ...');
						elseif($val->gridContent != 'null' && $val->gridModule == '[form]'){
							$form = new Form;
							$form = $form->getForm($val->gridContent);
							$html = new HtmlForm($form,$val->gridContent);
							$layout = $html->createForm();
							$grid->set('text',$layout->attributes['text']);
						}
						$articleLink->inject($grid);
						
						$card->inject($articleLink);
					}
					$line->inject($card);
				}
				$this->layout[] = $line;
			}
			return $this;
		}else {
			return $this;
		}
	}

	public function render(){
		foreach ($this->layout as $key => $value) {
			$value->output();
		}
	}
}