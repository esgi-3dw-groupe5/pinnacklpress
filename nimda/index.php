<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$timestart=microtime(true);

require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use nimda\controller\util\PluginHelper;

use sophwork\modules\handlers\requests\Requests;
use nimda\controller\access\Controller;

use controller\utils\Users;

$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;
	$KDM = $controller->KDM;

$controller->user = new Users();

$uri = preg_split("#/#", $_SERVER['REQUEST_URI']);

/**
 *	@var $adminSection refer to what admin section we currently are.
 * 	@var $controllerPrefix use to create the right class between nimda classes and user nimda classes.
 *	
 * 	User case
 *  no need to check permission, read only for every one except the owner is connected.
 */
if (in_array('user', $uri)) {
	$adminSection = 'user/' . $page;
	$controllerPrefix = 'User';
	$menu = [
		'page_tag' => [
			'posts',
			'info',
		
		],
		'page_name' => [
			'Posts',
			'Info',
			
		],
	];
	if(strtolower($controller->user->pseudo) == $controller->page){
		$menu['page_tag'][] = 'comments';
		$menu['page_name'][] = 'Comments';

		$menu['page_tag'][] = 'history';
		$menu['page_name'][] = 'History';
	}
} 
/**
 * 	Nimda case
 * 	@var $controllerPrefix use to create the right class between nimda classes and user nimda classes.
 */
elseif (in_array('nimda', $uri)) {
	$accesControl = new Controller();
	$accesControl->checkPermission('moderator');

	$adminSection = 'nimda';
	$controllerPrefix = null;
	$menu = [
		'page_tag' => [
			/*'overview',*/
			'users',
			'pages',
			'posts',
			'comments',
			'categories',
			'menus',
			'footers',
			'forms',
			'themes',
			'settings',
		],
		'page_name' => [
			/*'Overview',*/
			'Users',
			'Pages',
			'Posts',
			'Comments',
			'Categories',
			'Menus',
			'Footers',
			'Forms',
			'Themes',
			'Settings',
		],
	];
}

if(in_array('nimda', $uri) && in_array('user', $uri)){
	Sophwork::redirect();
}

/**
 * Lead by default on overver when connected onn nimda.
 */
if(is_null($controllerPrefix) && $page == 'index')
	Sophwork::redirect('nimda/pages');
elseif(!is_null($controllerPrefix) && $controller->article === false){
	Sophwork::redirect();
}
/**
 * Lead by default on post of the page user
 */
else{
	if(!is_null($controllerPrefix) && $controller->article == "")
		Sophwork::redirect('user/' . $page . '/posts');
}

if(!in_array('user', $uri) && !in_array($uri[count($uri)-1], $menu['page_tag'])){
	$app = $controller;
	$headers = [
		"HTTP/1.0 404 Not Found",
	];
	$requests = new Requests($headers, function() use ($app){
		$app->setViewData('siteurl', Sophwork::getUrl('nimda/'));
		$app->setViewData('errorNb', '404');
		$app->setViewData('errorMsg','Not Found');
		$app->setViewData('url', isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:Sophwork::geturl());
		$app->appView->renderView('error', 'nimda/');
		exit;
	});
    exit;
}

// if(!in_array('nimda', $uri) && !in_array($uri[count($uri)-1], $menu['page_tag'])){
// 	$app = $controller;
// 	$headers = [
// 		"HTTP/1.0 404 Not Found",
// 	];
// 	$requests = new Requests($headers, function() use ($app){
// 		$app->setViewData('siteurl', Sophwork::getUrl('nimda/'));
// 		$app->setViewData('errorNb', '404');
// 		$app->setViewData('errorMsg','Not Found');
// 		$app->setViewData('url', isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:Sophwork::geturl());
// 		$app->appView->renderView('error', 'nimda/');
// 		exit;
// 	});
//     exit;
// }

/**
 * @var $page = $controller->article
 * If it the case we not create the first level controller which is the user page name
 * but the section controller which is in this variable.
 */
if(!is_null($controllerPrefix) && $controller->article != "")
	$page = $controller->article;

$options = $KDM->create('pp_option');
$options->findOptionName("siteurl");
$siteurl = $options->getOptionValue()[0];
$options->findOptionName('sitename');
$sitename = $options->getOptionValue()[0];
$options->findOptionName('sitedescription');
$sitedescription = $options->getOptionValue()[0];

$plugins = PluginHelper::checkPlugins();
if(!is_null($plugins)){
	$menu['page_tag'][] = $plugins;
	$menu['page_name'][] = ucfirst($plugins);
}

$controller->setViewData('title', $sitename.' '.$sitedescription);
$controller->setViewData('adminSection', $adminSection);
$controller->setViewData('siteurl', $siteurl);
$controller->setViewData('userPseudo', !is_null($controller->user->pseudo)?$controller->user->pseudo:'');
$controller->setViewData('menu', $menu, 'page_tag');
$controller->setViewData('menu', $menu, 'page_name');

// $controller->appView->renderView('header', 'nimda/');

if(is_null($controllerPrefix))
	$control = 'nimda\controller\setup\\' . ucfirst($page);
else
	$control = 'nimda\controller\user\\'. $controllerPrefix . ucfirst($page);

$pageController = $controller->pageController = new $control($app->config);

$pageController->renderView($page);

include('template/footer-admin.tpl');

//End PHP code
$timeend=microtime(true);
$time=$timeend-$timestart;
 
//Execution time
$page_load_time = number_format($time, 3);
echo "<!--Start of script: ".date("H:i:s", $timestart);
echo "<br>End of script: ".date("H:i:s", $timeend);
echo "<br>Script execute in " . $page_load_time . " sec-->";