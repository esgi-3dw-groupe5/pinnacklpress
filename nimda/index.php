<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use nimda\controller\util\PluginHelper;

use nimda\controller\access\Controller;

use controller\utils\Users;

$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;
	$KDM = $controller->KDM;
$controller->user = new Users();

$uri = preg_split("#/#", $_SERVER['REQUEST_URI']);

if(in_array('user', $uri)){
	echo 'welcome to user interface';
	exit;
}
if($page == 'index')
	Sophwork::redirect('nimda/overview');

$accesControl = new Controller();
$accesControl->checkPermission('moderator');

$options = $KDM->create('pp_option');
$options->findOptionName("siteurl");
$siteurl = $options->getOptionValue()[0];
$options->findOptionName('sitename');
$sitename = $options->getOptionValue()[0];
$options->findOptionName('sitedescription');
$sitedescription = $options->getOptionValue()[0];

$menu = [
	'page_tag' => [
		'overview',
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
		'Overview',
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

$plugins = PluginHelper::checkPlugins();
if(!is_null($plugins)){
	$menu['page_tag'][] = $plugins;
	$menu['page_name'][] = ucfirst($plugins);
}

$controller->setViewData('title', $sitename.' '.$sitedescription);
$controller->setViewData('siteurl', $siteurl);
$controller->setViewData('userPseudo', $controller->user->pseudo);
$controller->setViewData('menu', $menu, 'page_tag');
$controller->setViewData('menu', $menu, 'page_name');

$controller->appView->renderView('header', 'nimda/');

$view = $app->appView;

$control = 'nimda\controller\setup\\' . ucfirst($page);

$pageController = $controller->pageController = new $control($app->config);
$pageController->renderView($page);

include('template/footer-admin.tpl');
