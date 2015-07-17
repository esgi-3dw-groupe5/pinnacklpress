<?php

namespace sophwork\modules\htmlElements;
use sophwork\core\Sophwork;
use controller\form\Form;
use sophwork\modules\htmlElements;

class htmlPage extends htmlElement{
	
	protected $data;
	protected $layout;

	public function __construct($data){
		if(!is_array($data))
			$this->data = json_decode($data);
		else
			$this->data = $data;
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
						$grid->set('class', $val->gridClass . ' page-artcile');
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
			$c = "";

			foreach ($this->data['title'] as $k => $subValue) {
				$card = new htmlElement('div');
				$card->set('class', 'grid-1_3 articles');
				$title   = $this->data['title'][$k];
				$content = substr(strip_tags(trim(json_decode($this->data['content'][$k])[0]->line[0]->gridContent)), 0, 200);
				$authorName  = $this->data['author'][$k];
				$tag     = $this->data['tag'][$k];
				$date = date_format(date_create($this->data['date'][$k]), "Y/m/d");
				$header = new htmlElement('div');
				$header->set('class', 'grid-4_4 author');
				$meta = new htmlElement('div');
				$meta->set('class', 'grid-3_4');
				$meta->set('text', $authorName);
				$header->inject($meta);
				$meta = new htmlElement('div');
				$meta->set('class', 'grid-3_4 date');
				$meta->set('text', $date);
				$header->inject($meta);
				
				$meta = new htmlElement('div');
				$meta->set('class', 'grid-3_4 categories');
				$nbCategory = 0;
				$currentCategory = [];
				foreach ($this->data['category'][$k] as $key => $value) {
					$category = new htmlElement('a');
					$currentCategory[] = $this->data['catLink'][$k][$key];
					$category->set('href', Sophwork::getUrl($currentCategory[$nbCategory]));
					$category->set('class', 'grid-1_4 vignette');
					$category->set('text', $value);
					$meta->set('text', $meta->get('text').$category->build());
					$nbCategory++;
				}
				$header->inject($meta);

				$meta = new htmlElement('h3');
				$meta->set('class', 'grid-3_4 title');
				$meta->set('text', $title);
				$header->inject($meta);

				$authorLink = new htmlElement('a');
				$authorLink->set('href', Sophwork::getUrl('user/'.$authorName)); // FIXME : 'user/' . $authorName
					
				$img = new htmlElement('img');
				$img->set('src', Sophwork::getUrl('data/users/'.$authorName.'/'.$authorName.'.jpg')); // FIXME : 'data/users/' . $authorName . '/' . $authorName . '.jpg'
				$authorLink->inject($img);
				$header->inject($authorLink);
				$card->inject($header);
				$grid = new htmlElement('div');
				$grid->set('class', 'grid-4_4 preview');
				$articleLink = new htmlElement('a');
				$articleLink->set('href', Sophwork::getUrl($currentCategory[0] . '/' . $tag));
				$content = preg_replace("/<img[^>]+\>/i", '', $content);
				$articleLink->set('text', $this->closetags($content) . '...');
				$grid->inject($articleLink);
						
				$card->inject($grid);
				$line->set('text', $line->get('text').$this->closetags($card->build()));
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

	public function closetags($html) {
	    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	    $openedtags = $result[1];
	    preg_match_all('#</([a-z]+)>#iU', $html, $result);
	    $closedtags = $result[1];
	    $len_opened = count($openedtags);
	    if (count($closedtags) == $len_opened) {
	        return $html;
	    }
	    $openedtags = array_reverse($openedtags);
	    for ($i=0; $i < $len_opened; $i++) {
	        if (!in_array($openedtags[$i], $closedtags)) {
	            $html .= '</'.$openedtags[$i].'>';
	        } else {
	            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
	        }
	    }
	    return $html;
	} 
}