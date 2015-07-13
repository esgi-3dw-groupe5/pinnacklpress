<?php

namespace sophwork\modules\htmlElements;
use sophwork\core\Sophwork;
use controller\form\Form;
use sophwork\modules\htmlElements;

class htmlPage extends htmlElement{
	
	protected $data;
	protected $layout;

	public function __construct($data){
		if(!is_array($data)){
			$this->data = json_decode($data);
		}else $this->data = $data;
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

			$card = new htmlElement('div');
			$card->set('class', 'grid-1_3 articles');
			foreach ($this->data['title'] as $k => $subValue) {

				$title   = $this->data['title'][$k];
				$content = substr($this->data['content'][$k], 0,100);
				$author  = $this->data['author'][$k];
				$tag     = $this->data['tag'][$k];
				$date    = $this->data['date'][$k];

				$authorLink = new htmlElement('a');
				$authorLink->set('href', Sophwork::getUrl('user/Syu93')); // FIXME : 'user/' . $author
					
				$img = new htmlElement('img');
				$img->set('src', Sophwork::getUrl('data/users/Syu93/Syu93.jpg')); // FIXME : 'user/' . $author . '/' . $author . '.jpg'
					
				$authorLink->inject($img);

				$auteur = new htmlElement('div');
				$auteur->set('class', 'auteur');
				$auteur->set('text', $author); 
				$auteur->inject($authorLink);
				$card->inject($auteur);

				$articleLink = new htmlElement('a');
				$articleLink->set('href', Sophwork::getUrl($tag));

				$grid = new htmlElement('div');
				$grid->set('class', 'articles' . ' preview');
				$grid->set('text', $content . ' ...');

				$articleLink->inject($grid);
						
				$card->inject($articleLink);

				$line->inject($card);
			}
			$this->layout[] = $line;
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