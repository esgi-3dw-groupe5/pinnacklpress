<?php
require('../sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

$sophwork = new Sophwork();
$app = new SophworkApp();
	$app->appName='Pinnackl Press';
$controller = $app->appController;
	$page = $controller->page;

$loader = new SophworkTELoader();
$template = $loader->loadFromFile("template/".$app->appController->page.".tpl");
$KTE = new SophworkTEParser($template, [
	'css' => ['base/base', 'buttons/buttons'],
]);
print $KTE->parseTemplate();


// debug
echo'<pre>';
// var_dump($app);
// var_dump($controller);
var_dump($page);
echo'</pre>';