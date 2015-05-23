<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

// -- Pinnackl Press --
use nimda\controller\setup\Overview;
use nimda\controller\setup\Page;

$sophwork = new Sophwork();
	 // FIXME : Dynamicaly set the root path for htaccess
	$sophwork->setHtaccess('pinnacklpress/nimda', dirname(__FILE__));

$app = new SophworkApp();
	$app->appName='Pinnackl Press';

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
		'forms',
	],
	'page_name' => [
		'Overview',
		'Pages',
		'Posts',
		'Categories',
		'Menus',
		'Forms',
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

include('template/footer.tpl');
