<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	This file if for exemple purpose
 *	It's show you the way to use the Sophwork framework basises
 *	feel free to edit it or recreate your own for your project.
 *	NOTE : Uncomment the exemples bellow to see it works
 */
require_once('sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;
// use modules
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\form\Validator;
use controller\form\Form;

/**
 *	Create a new applicaion with the Sophwork class
 *	It will create 3 new class :
 *		- appController class
 *		- appModel class
 *		- appView class
 */
$sophwork = new Sophwork();
$app = new SophworkApp();

$controller = $app->appController;

	$action = $controller->setConfigAction($_POST);
$controller->sendConfigAction($action, $_POST);