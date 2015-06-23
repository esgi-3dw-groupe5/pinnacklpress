<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 */
require_once('sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
// use modules
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\controllers\core\Controllers;


/**
 *	Create a new applicaion with the Sophwork class
 *	It will create 3 new class :
 *		- appController class
 *		- appModel class
 *		- appView class
 */
$app = new SophworkApp();
$pageController = new Controllers();
$pageController->callThemeView('index');
