<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;
	$KDM = $controller->KDM;

if($page == 'index')
	Sophwork::redirect('nimda/overview');

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
		'pages',
		'posts',
		'categories',
		'menus',
		'footers',
		'forms',
		'themes',
		'settings',
	],
	'page_name' => [
		'Overview',
		'Pages',
		'Posts',
		'Categories',
		'Menus',
		'Footers',
		'Forms',
		'Themes',
		'Settings',
	],
];

$controller->setViewData('title', $sitename.' '.$sitedescription);
$controller->setViewData('siteurl', $siteurl);
$controller->setViewData('menu', $menu, 'page_tag');
$controller->setViewData('menu', $menu, 'page_name');

$controller->appView->renderView('header', 'nimda/');

$view = $app->appView;

$control = 'nimda\controller\setup\\' . ucfirst($page);

$pageController = $controller->pageController = new $control($app->config);
$pageController->renderView($page);

include('template/footer-admin.tpl');
