<?php

namespace controller\controllers\core;

use sophwork\core\Sophwork;
use sophwork\app\controller\AppController;
	// KTE
use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

class Controllers extends AppController{

	public function __construct(){
		parent::__construct();
		// echo 'Your are on the ' . $this->page . ' controller';
		$view = $this->appView; // Class variable ?

		// Get option for all pages
		$options = $this->KDM->create('pp_option');
		$options->findOptionName("sitename");
		$sitename = $options->getOptionValue()[0];

		$options->findOptionName("sitedescription");
		$sitedescription = $options->getOptionValue()[0];

		$options->findOptionName("siteurl");
		$siteurl = $options->getOptionValue()[0];
		
		$pages = $this->KDM->create('pp_page');
		$pages->findPageDisplay('yes');
			$tags = $pages->getPageTag();

		$this->setViewData('sitename', $sitename);
		$this->setViewData('sitedescription', $sitedescription);
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('menu', $pages->getData(), 'page_tag');
		$this->setViewData('menu', $pages->getData(), 'page_name');

		$this->callView($this->page);
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}
}