<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

use nimda\controller\access\Controller;

class Pages extends Controller{
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
		
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Pages configuration');

		if($action == 'delete'){
			$pages->findPageType('page');
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_tag');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_order');
			$this->setViewData('pages', $pages->getData(), 'page_connectedAs');
			$this->setViewData('pages', $pages->getData(), 'page_status');
			$this->setViewData('pages', $pages->getData(), 'page_type');
			
			$this->callView($page, 'nimda/');
		}
		elseif($action == 'edit'){ // FIXME : better handle blank cases
			$pages->findPageId($edit);

			// GET FORMS NAME
			$forms = $KDM->create('pp_form');
			$forms->find();
			$forms->getData();
			$this->setViewData('forms', $forms->getData(), 'form_name');
			
			$this->setViewData('page_tag', ''.$pages->getPageTag()[0]);
			$this->setViewData('page_name', ''.$pages->getPageName()[0]);
			$this->setViewData('page_order', ''.$pages->getPageOrder()[0]);
			$this->setViewData('page_connectedAs', ''.$pages->getPageConnectedAs()[0]);
			$this->setViewData('page_status', ''.$pages->getPageStatus()[0]);
			$this->setViewData('page_comment_status', ''.$pages->getPageCommentStatus()[0]);
			$this->setViewData('page_type', ''.$pages->getPageType()[0]);
			
			$contents->findPageId($pages->getPageId()[0]);
			if(!is_null($contents->getPmetaId()[0])){
					$data = $contents->getData()['pmeta_value'][0];
					$html = new htmlBuilder($data);
					$layout = $html->createBuilder();
					$this->setRawData('layout', $layout);
			}
			else{
				$html = new htmlBuilder('[]');
				$layout = $html->createBuilder();
				$this->setRawData('layout', $layout);
			}

			$this->callView($page .'-edit', 'nimda/');
		}
		elseif($action == 'new'){
			$this->callView($page .'-new', 'nimda/');
		}
		else{
			$pages->findPageType('page');
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_tag');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_order');
			$this->setViewData('pages', $pages->getData(), 'page_connectedAs');
			$this->setViewData('pages', $pages->getData(), 'page_status');
			$this->setViewData('pages', $pages->getData(), 'page_type');
			
			$this->callView($page, 'nimda/');
		}
	}
}