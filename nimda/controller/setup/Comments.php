<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use nimda\controller\access\Controller;

class Comments extends Controller{
	public $config;
	protected $forms;
	protected $fields;
	protected $form;

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
		$action = Sophwork::getParam('a','');
		$edit = Sophwork::getParam('e', '');

		$options = $KDM->create('pp_option');
		$options->findOptionName('siteurl');
		$siteurl = $options->getOptionValue()[0];

		$comments = $KDM->create('pp_comment');

		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Comments administration');

		if($action == 'edit'){

			$comment->findComId($edit);

            $this->setViewData('com_content', ''.$comment->getComContent()[0]);
            $this->setViewData('com_post', ''.$comment->getPostId()[0]);
            $this->setViewData('com_author', ''.$comment->getComAuthor()[0]);
            $this->setViewData('com_date', ''.$comment->getComDate()[0]);
            $this->setViewData('com_update', ''.$comment->getComUpdate()[0]);
            $this->setViewData('com_active', ''.$comment->getComActive()[0]);

            $this->callView($page .'-edit', 'nimda/');

		}elseif($action == 'delete'){
			$comments->find();

			$this->setViewData('comments', $comments->getData(), 'com_id');
			$this->setViewData('comments', $comments->getData(), 'com_content');
			$this->setViewData('comments', $comments->getData(), 'post_id');
			$this->setViewData('comments', $comments->getData(), 'com_author');
			$this->setViewData('comments', $comments->getData(), 'com_date');
			$this->setViewData('comments', $comments->getData(), 'com_update');
			$this->setViewData('comments', $comments->getData(), 'com_active');

			$this->callView($page, 'nimda/');
		}else{
			$comments->find();
			$author = $KDM->create('pp_user');
			$pageComment = $KDM->create('pp_page');
			$infos = $comments->getData();

			if(!empty($infos['com_author'])){
				foreach ($infos['com_author'] as $key => $value) {
					$author->findUserId($comments->getData()['com_author'][$key]);
					$infos['com_author'][$key] = $author->getUserPseudo()[0];
				}
			}
			
			if(!empty($infos['post_id'])){
				foreach ($infos['post_id'] as $key => $value) {
					$pageComment->findPageId($comments->getData()['com_author'][$key]);
					$infos['post_id'][$key] = $pageComment->getPageName()[0];
				}
			}

			$this->setViewData('comments', $infos, 'com_id');
			$this->setViewData('comments', $infos, 'com_content');
			$this->setViewData('comments', $infos, 'post_id');
			$this->setViewData('comments', $infos, 'com_author');
			$this->setViewData('comments', $infos, 'com_date');
			$this->setViewData('comments', $infos, 'com_update');
			$this->setViewData('comments', $infos, 'com_active');

			$this->callView($page, 'nimda/');
		}
	}
}