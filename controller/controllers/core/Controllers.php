<?php

namespace controller\controllers\core;

use sophwork\core\Sophwork;
use sophwork\app\controller\AppController;

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
		$this->initOption();
		$menu = $this->initMenu();
		$pageContent = $this->initPageContent($menu);
		$this->initUser($pageContent);
		$this->initFooter();
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function initOption(){
		$options = $this->KDM->create('pp_option');
		$options->findOptionName("sitename");
		$sitename = $options->getOptionValue()[0];

		$options->findOptionName("sitedescription");
		$sitedescription = $options->getOptionValue()[0];

		$options->findOptionName("siteurl");
		$siteurl = $options->getOptionValue()[0];

		$options->findOptionName("theme");
		$theme = $options->getOptionValue()[0];
		$this->appView->theme = $theme;

		$options->findOptionName("sidebar");
		$sidebar = $options->getOptionValue()[0];

		$this->setViewData('sitename', $sitename);
		$this->setViewData('sitedescription', $sitedescription);
		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('theme', $theme);
		$this->setViewData('sidebar', $sidebar);
	}

	public function initPageContent($menu){
		$page = $this->KDM->create('pp_page');
		$page->findPageTag($this->page);

		$pageContent = $this->KDM->create('pp_pagemeta');

		$page = $menu->permaLink($page);

		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('content')
			->querySelect();
        
        if(!is_null($page->getPageId()[0])) {
            $pageType = $page->getPageType()[0];
            $data = $pageContent->getPmetaValue()[0];
            $slug = $page->getPageName()[0];
            $html = new htmlPage($data);
            if($pageType == 'page')
                $layout = $html->createPage();
			elseif($pageType == 'category'){
				$idCateg = $page->getPageId()[0];
				$posts = new Post();
				$data = $posts->getPostsByCateg($idCateg);
				$html = new htmlPage($data);
				$layout = $html->createPostList();
			}
            if($slug != 'Index')
                $this->setViewData('sitedescription', $slug);
            $this->setRawData('page', $layout);
            return $page;
        }
        else {
            header("HTTP/1.0 404 Not Found");
            echo 'test';
            exit();
        }


		$pageType = $page->getPageType()[0];

		$data = $pageContent->getPmetaValue()[0];
		$slug = $page->getPageName()[0];
		$html = new htmlPage($data);
		if($pageType == 'page')
			$layout = $html->createPage();
		elseif($pageType == 'category'){
			$idCateg = $page->getPageId()[0];
			$posts = new Post();
			$data = $posts->getPostsByCateg($idCateg);
			$html = new htmlPage($data);
			$layout = $html->createPostList();
		}
		if($slug != 'Index')
			$this->setViewData('sitedescription', $slug);
		$this->setRawData('page', $layout);
		return $page;
	}

	public function initMenu(){
		$menu = new Menu();
		$links = $menu->create('primary');
		$this->setRawData('links', $links);
		return $menu;
	}
    
    public function initFooter(){
		$footer = $this->KDM->create('pp_pagemeta');
		$footer
			->filterPmetaName('footer')
			->querySelect();

		$data = $footer->getPmetaValue()[0];
		$html = new htmlFooter($data);
		$layout = $html->createFooter();
		$this->setRawData('footer', $layout);
    }

    public function initUser($page){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$user = new Users();
			if(!isset($_SESSION['user']))
				$user->initUser();
		}
		$roleNeedle = $page->getPageConnectedAs()[0];
        if(is_null($roleNeedle))
            echo 'test2';
		$user->checkPermission($roleNeedle);

		if( isset($_GET['act']) && $_GET['act']=='logout' ) {
		    $user->logout();
		}
    }
}