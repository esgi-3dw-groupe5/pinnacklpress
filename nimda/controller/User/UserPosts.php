<?php

namespace nimda\controller\user;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

use nimda\controller\access\Controller;

use controller\utils\Users;

class UserPosts extends Controller{
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

		$userPage = Sophwork::getParam('p', '');
		$action = Sophwork::getParam('a', '');
		$edit = Sophwork::getParam('e', '');
		$elses = preg_split("#/#", $edit);
		
		Users::startSession();
		$user = new Users();
		
		$own = '';
		if(strtolower($user->url) == $userPage)
			$own = 'own-';

		$options = $KDM->create('pp_option');
		$options->findOptionName('siteurl');
		$siteurl = $options->getOptionValue()[0];

		$pages = $KDM->create('pp_page');
		$contents = $KDM->create('pp_pagemeta');
		$categories = $KDM->create('pp_page');
		$categoriesRs = $KDM->create('pp_pagemeta');
		
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Posts');
		$this->setViewData('userPage', $userPage);

		if($elses[0] == 'delete'){
			$pages->findPageType('post');
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_udate');

			$this->setViewData('pages', $categories->getData(), 'page_name');
			
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_status');
			
			$this->callView('user/' . $own . $page, 'nimda/');
		}
		elseif($elses[0] == 'edit'){
			$pages->findPageId($elses[1]);
			$this->setViewData('page_name', ''.$pages->getPageName()[0]);
			$this->setViewData('page_order', ''.$pages->getPageOrder()[0]);
			$this->setViewData('page_connectedAs', ''.$pages->getPageConnectedAs()[0]);
			$this->setViewData('page_status', ''.$pages->getPageStatus()[0]);
			$this->setViewData('page_comment_status', ''.$pages->getPageCommentStatus()[0]);;
			
			$contents
				->filterPageId($pages->getPageId()[0])
				->__and()
				->filterPmetaName('content')
				->querySelect();

			$key = 0;
			$jsonBuilder = json_decode($contents->getPmetaValue()[0]);
			$contentSys = $jsonBuilder[$key]->line;
			$postContent = $contentSys[0];

			$this->setViewData('page_content', ''.$postContent->gridContent);

			$categories->findPageType('category');
			$this->setViewData('category', $categories->getData(), 'page_id');
			$this->setViewData('category', $categories->getData(), 'page_name');

			$categoriesRs
				->filterPageId($elses[1])
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

			$this->callView('user/' . $own . $page .'-edit', 'nimda/');
		}
		elseif($elses[0] == 'new'){
			$categories->findPageType('category');
			$this->setViewData('category', $categories->getData(), 'page_id');
			$this->setViewData('category', $categories->getData(), 'page_name');

			$this->callView('user/' . $own . $page .'-new', 'nimda/');
		}
		else{
			$pages->findPageType('post');
			$pages->getPageId();
			var_dump($pages->getPageId()[0]);
			$contents
				->filterPageId($pages->getPageId()[0])
				->__and()
				->filterPmetaName('content')
				->querySelect();

			$key = 0;
			$jsonBuilder = json_decode($contents->getPmetaValue()[0]);
			$contentSys = $jsonBuilder[$key]->line;
			$postContent = $contentSys[0];

			$this->setViewData('page_content', ''.$postContent->gridContent);

			$categories->findPageType('category');
			$this->setViewData('category', $categories->getData(), 'page_id');
			$this->setViewData('category', $categories->getData(), 'page_name');			

			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_name');
			$this->setViewData('pages', $pages->getData(), 'page_udate');
			$this->setViewData('pages', $pages->getData(), 'page_udate');
			$this->setViewData('pages', $categories->getData(), 'page_name'); //categories
			
			
			$this->callView('user/' . $own . $page, 'nimda/');
		}
	}
}