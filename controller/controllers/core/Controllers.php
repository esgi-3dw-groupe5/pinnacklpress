<?php

namespace controller\controllers\core;

use sophwork\core\Sophwork;
use sophwork\app\controller\AppController;
	// KTE
use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use sophwork\modules\htmlElements\htmlElement;
use sophwork\modules\htmlElements\htmlPage;

use sophwork\modules\htmlElements\htmlForm;
use sophwork\modules\htmlElements\htmlFooter;

use controller\utils\Users;
use controller\utils\Menu;
use controller\posts\Post;

use controller\form\Form;
use controller\form\Validator;
    
class Controllers extends AppController{


	public function __construct(){
		parent::__construct();
		$view = $this->appView; // Class variable ?
        
        session_start();
        $user = new Users();
        $user->initUser();

        $menu = new Menu();
        $links = $menu->create('primary');
		$this->setRawData('links', $links);

		// Get option for all pages
		$options = $this->KDM->create('pp_option');
		$options->findOptionName("sitename");
		$sitename = $options->getOptionValue()[0];

		$options->findOptionName("sitedescription");
		$sitedescription = $options->getOptionValue()[0];

		$options->findOptionName("siteurl");
		$siteurl = $options->getOptionValue()[0];
		
		$options->findOptionName("theme");
		$theme = $options->getOptionValue()[0];

		$options->findOptionName("sidebar");
		$sidebar = $options->getOptionValue()[0];

		$this->setViewData('sitename', $sitename);
		$this->setViewData('sitedescription', $sitedescription);
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('theme', $theme);
		$this->setViewData('sidebar', $sidebar);
		
		// set the theme. By default pure theme is used
		$view = $this->appView; // Class variable ?
		$view->theme = $theme;

		$page = $this->KDM->create('pp_page');
		$page->findPageTag($this->page);
		$pageContent = $this->KDM->create('pp_pagemeta');
		$footer = $this->KDM->create('pp_pagemeta');

		$menu->permaLink($page);

		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('content')
			->querySelect();

		$data = $pageContent->getPmetaValue()[0];
		$slug = $page->getPageName()[0];
		$html = new htmlPage($data);
		$layout = $html->createPage(); // create a post method
		if($slug != 'Index') //FIXME : create an index attribute to find here
			$this->setViewData('sitedescription', $slug);
		$this->setRawData('page', $layout);

		$footer
			->filterPmetaName('footer')
			->querySelect();

		$data = $footer->getPmetaValue()[0];
		$html = new htmlFooter($data);
		$layout = $html->createFooter();
		$this->setRawData('footer', $layout);

        $roleNeedle = $page->getPageConnectedAs()[0];
        $user->checkPermission($roleNeedle);
        
        
        
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}
    
}