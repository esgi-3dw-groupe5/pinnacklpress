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

// Header template
$loader = new SophworkTELoader();
$template = $loader->loadFromFile("template/header.tpl");
$KTE = new SophworkTEParser($template, [
	'title' => 'Nimda',
	'siteurl' => $siteurl,
	'menu' => ['Overview','Pages'],
	'active' => ['active'],
]);
print $KTE->parseTemplate();

$control = 'nimda\controller\setup\\' . ucfirst($page);
$pageController = $controller->pageController = new $control($app->config);
var_dump($app->getParam('e', ''));
	$pageController->renderView($page);

echo '</div></body></html>'; // Layout