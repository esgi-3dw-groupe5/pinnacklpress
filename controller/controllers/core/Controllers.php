<?php

namespace controller\controllers\core;

use sophwork\core\Sophwork;
use sophwork\app\controller\AppController;

use sophwork\modules\handlers\requests\Requests;

use sophwork\modules\htmlElements\htmlElement;
use sophwork\modules\htmlElements\htmlPage;

use sophwork\modules\htmlElements\htmlForm;
use sophwork\modules\htmlElements\htmlFooter;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

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
		/**
		 * Create a page KDM object and get the current page by tag (slug)
		 * @var SophworkDMEntities
		 */
		$page = $this->KDM->create('pp_page');
		$page
			->filterPageTag($this->page)
			->__and()
			->filterPageStatus('publish')
			->querySelect();

		/**
		 * Create a page meta KDM object
		 * @var SophworkDMEntities
		 */
		$pageContent = $this->KDM->create('pp_pagemeta');
		/**
		 * Redirect vers the right article if slug direcly passed without category
		 * The permalink if defined in the database
		 * @var SophworkDMEntities
		 */
		$page = $menu->permaLink($page);
		
		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('role')
			->querySelect();
		Users::startSession();
		if(!empty($_SESSION['user']['pseudo'])
			&& ($pageContent->getPmetaValue()[0] == 'connection' || $pageContent->getPmetaValue()[0] == 'inscription'))
			Sophwork::redirect();
		/**
		 * Create a page meta KDM object
		 * @var SophworkDMEntities
		 */
		$pageContent = $this->KDM->create('pp_pagemeta');

		/**
		 * If not redirected, try to get the page contents from page meta table
		 */
		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('content')
			->orderByPmetaId()
			->querySelect();

		/**
		 * Read a page/post
		 * 
		 * If the page id retrieve from the tag is not null (so a page correspond)
		 * get information from the page page meta objects
		 *
		 * If the page id retrieve from the tag is null (so no page correspond)
		 * redirect to error page with the rique header
		 *
		 * If the page is a post or page render with the content
		 * If the page is a cetegory, get the categorie id and call Post to get all article from this category
		 */
		if($page->getPageType()[0] == 'post'){
			$comments = $this->KDM->create('pp_comment');
			$comments
				->filterPostId($page->getPageId()[0])
				->__and()
				->filterComActive(1)
				->orderByComDate('DESC')
				->querySelect();
		}

        if(!is_null($page->getPageId()[0])) {
            $pageType = $page->getPageType()[0];
            $data = $pageContent->getPmetaValue()[0];	// $data : the page content
            $slug = $page->getPageName()[0];
            $html = new htmlPage($data);
            if($pageType == 'page' || $pageType == 'post' )
                $layout = $html->createPage();
			elseif($pageType == 'category'){
				$idCateg = $page->getPageId()[0];
				$posts = new Post();
				$data = $posts->getPostsByCateg($idCateg);	// $data : multiple pages contents
				$html = new htmlPage($data);
				$layout = $html->createPostList();
			}elseif ($pageType == 'article') {
				$posts = new Post();
				$data = $posts->getPosts();
				$html = new htmlPage($data);
				$layout = $html->createPostList();
			}
			if( $pageType == 'post'){
				$KDM = new SophworkDM($this->config);
				$author = $KDM->create('pp_user');
            	$data = $comments->getData();
            	if(!empty($data['com_author'])){
					foreach ($data['com_author'] as $key => $value) {
						$author->findUserId($comments->getData()['com_author'][$key]);
						$data['com_author'][$key] = $author->getUserPseudo()[0];
					}
				}

				$history = $KDM->create('pp_history');
				$history->findUserId($_SESSION['user']['id']);

				if($history->getData()['post_id'] != $page->getPageId()[0]) {
					$history->setUserId($_SESSION['user']['id']);
					$history->setPostId($page->getPageId()[0]);
					$history->setHistoryDate(date("Y-m-d h:i:s"));
					$history->setHistoryStatus(1);
					$history->save();
				}


            	$html = new htmlPage($data);
            	$layoutComment = $html->createComment();
            	$this->setRawData('comment', $layoutComment);
            }
            if($slug != 'Index')
                $this->setViewData('sitedescription', $slug);
            $this->setRawData('page', $layout);

            return $page;
        }
        else {
            if($this->page == 'access-error'){
				$app = $this;
				$headers = [
					"HTTP/1.0 403 Forbidden",
				];
				$requests = new Requests($headers, function() use ($app){
					$app->setViewData('errorNb', '403');
					$app->setViewData('errorMsg','Forbidden');
					$app->setViewData('url', isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:Sophwork::geturl());
					$app->callThemeView('error');
					exit;
				});
            }
			$app = $this;
			$headers = [
				"HTTP/1.0 404 Not Found",
			];
			$requests = new Requests($headers, function() use ($app){
				$app->setViewData('errorNb', '404');
				$app->setViewData('errorMsg','Not Found');
				$app->setViewData('url', isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:Sophwork::geturl());
				$app->callThemeView('error');
				exit;
			});
            exit;
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
		if (Users::sessionStarted()) {
			Users::startSession();
			$user = new Users();
			if(!isset($_SESSION['user']))
				$user->initUser();
		}
		$roleNeedle = $page->getPageConnectedAs()[0];
        // if(is_null($roleNeedle)){
            // header("HTTP/1.0 404 Not Found");
            // echo '<h1>404 not found</h1>';
            // exit();
        // }
		$this->checkPermission($roleNeedle);

		if( isset($_GET['act']) && $_GET['act']=='logout' ) {
		    $user->logout();
		}
    }

   public function checkPermission($permission){
        Users::startSession();
        if(!isset($_SESSION['user']))
        	Sophwork::redirect();

        $roles = [
            'superadmin' => [
                'superadmin',
                'administrator',
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            "administrator" => [
                'administrator',
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'moderator' => [
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'editor' => [
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'author' => [
                'author',
                'member',
                'visitor',
            ],

            'member' => [
                'member',
                'visitor'
            ],
            'visitor' => [
                'visitor'
            ],
        ];            	
        
        if(!in_array($permission, $roles[$_SESSION['user']['role']])){
			Sophwork::redirect('access-error');
			exit;
        }
    }
}