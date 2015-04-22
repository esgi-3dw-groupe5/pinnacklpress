<?php
/*
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	This file if for exemple purpose
 *	It's show you the way to use the Sophwork framework basises
 *	feel free to edit it or recreate your own for your project.
 *	NOTE : Uncomment the exemples bellow to see it works
 */
echo "<h1><b><u>Welcome to Sophwork</u></b></h1>";
require_once('sophwork/autoloader.php');
// require_once('controller/controller.core.php');
// require('controller/controller.form.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;
use sophwork\app\view\AppView;
use sophwork\app\model\AppModel;
// use modules
	// KTE
// use sophwork\modules\kte\SophworkTELoader;
// use sophwork\modules\kte\SophworkTELexer;
// use sophwork\modules\kte\SophworkTEParser;
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
use controller\form\Validator;
use controller\form\Form;

/*
 *	Create a new applicaion with the Sophwork class
 *	It will create 3 new class :
 *		- appController class
 *		- appModel class
 *		- appView class
 */
$sophwork = new Sophwork();
$app = new SophworkApp();
// This case use the default appView class to render the view
// $appView = $app->appView;
// 	$appView->renderView('config');

// get the config form
$controller = $app->appController;
	$action = $controller->setConfigAction($_POST);

$controller->sendConfigAction($action, $_POST);