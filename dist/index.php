<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$timestart=microtime(true);

require_once('sophwork/autoloader.php');
require_once('controller/posts/fluxRss.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

use controller\controllers\core\Controllers;

// update_fluxRSS(); // not here !!

if(!file_exists('config.local.php'))
	Sophwork::redirect('install');

$app = new SophworkApp();
$appController = $app->appController;
$pageController = new Controllers();
$pageController->callThemeView('index');

//End PHP code
$timeend=microtime(true);
$time=$timeend-$timestart;
 
//Execution time
$page_load_time = number_format($time, 3);
echo "<!--Start of script: ".date("H:i:s", $timestart);
echo "<br>End of script: ".date("H:i:s", $timeend);
echo "<br>Script execute in " . $page_load_time . " sec-->";