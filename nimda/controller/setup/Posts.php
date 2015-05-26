<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

class Posts extends \sophwork\app\controller\AppController{
	public $config;
	protected $forms;
	protected $fields;

	public function __construct($config = null){
		parent::__construct();
		$this->config = $config;
		$this->forms = [];
		$this->fields = [];
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function __getForms($param){
		return $this->forms[$param];
	}

	public function __setForms($param, $value){
		$this->forms[$param] = $value;
	}

	public function __getFields($param){
		return $this->fields[$param];
	}
 
	public function __setFields($param, $value){
		$this->fields[$param] = $value;
	}

	public function renderView($page = null, $path = null){
		$KDM = new SophworkDM($this->config);
		$action = Sophwork::getParam('a', '');
		$edit = Sophwork::getParam('e', '');
		
		$options = $KDM->create('pp_option');
		$options->findOptionName('siteurl');
		$siteurl = $options->getOptionValue()[0];

		$pages = $KDM->create('pp_page');
		$contents = $KDM->create('pp_pagemeta');
		$categories = $KDM->create('pp_page');
		$categoriesRs = $KDM->create('pp_pagemeta');
		
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Posts configuration');

		if($action == 'delete'){
			$pages->findPageType('post');
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_tag');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_order');
			$this->setViewData('pages', $pages->getData(), 'page_connectedAs');
			$this->setViewData('pages', $pages->getData(), 'page_status');
			
			$this->callView($page, 'nimda/');
		}
		elseif($action == 'edit'){ // FIXME : better handle blank cases
			$pages->findPageId($edit);
			$this->setViewData('page_name', ''.$pages->getPageName()[0]);
			$this->setViewData('page_order', ''.$pages->getPageOrder()[0]);
			$this->setViewData('page_connectedAs', ''.$pages->getPageConnectedAs()[0]);
			$this->setViewData('page_status', ''.$pages->getPageStatus()[0]);
			$this->setViewData('page_comment_status', ''.$pages->getPageCommentStatus()[0]);;
			
			$contents->findPageId($pages->getPageId()[0]);
			$this->setViewData('page_content', ''.$contents->getPmetaValue()[0]);

			$categories->findPageType('category');
			$this->setViewData('category', $categories->getData(), 'page_id');
			$this->setViewData('category', $categories->getData(), 'page_name');

			$categoriesRs
				->filterPageId($edit)
				->__and()
				->filterPmetaName('category')
				->querySelect();
			$linkedPage = $categoriesRs->getPmetaValue();
			if(is_null($linkedPage)){
				$linkedPage = [];
			}
			else{
				$this->setViewData('categories', $categoriesRs->getData(), 'pmeta_id');
			}
			$this->setRawData('linked' ,$linkedPage);

			$this->callView($page .'-edit', 'nimda/');
		}
		elseif($action == 'new'){
			$this->callView($page .'-new', 'nimda/');
		}
		else{
			$pages->findPageType('post');
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_udate');
			$this->setViewData('pages', $pages->getData(), 'page_name'); //categories
			$this->setViewData('pages', $pages->getData(), 'page_name'); // Author
			$this->setViewData('pages', $pages->getData(), 'page_status');
			
			$this->callView($page, 'nimda/');
		}
	}
}