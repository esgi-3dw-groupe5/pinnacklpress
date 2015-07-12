<?php
require(__DIR__ . '/../../../../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];


$sophwork = new Sophwork();
$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;

$optionPageController = preg_split("#/#", $_POST['pp-referer']);
/**
 *	Page
 */
if(in_array('edit', $optionPageController) 
	|| in_array('new', $optionPageController) 
	|| in_array('delete', $optionPageController)){ //FIXME : IS the level will alaway be 3 ?
	$optionPage = $optionPageController[count($optionPageController)-3];
	$edit = $optionPageController[count($optionPageController)-1];
}
else{
	$optionPage = $optionPageController[count($optionPageController)-1];
	$edit = $optionPageController[count($optionPageController)-1];
}

