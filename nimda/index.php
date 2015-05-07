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

if($page == 'index')
	Sophwork::redirect('nimda/overview');

// Header template
$loader = new SophworkTELoader();
$template = $loader->loadFromFile("template/header.tpl");
$KTE = new SophworkTEParser($template, [
	'title' => 'Nimda',
	'menu' => ['Overview','Pages','Formulaires'],
	'active' => ['active'],
]);
print $KTE->parseTemplate();

$control = 'nimda\controller\setup\\' . ucfirst($page);
$pageController = $controller->pageController = new $control($app->config);
	$pageController->renderView($page);

echo '</div></body></html>'; // Layout