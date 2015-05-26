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

use sophwork\modules\htmlElements\htmlForm;
use controller\form\Form;

use controller\utils\Users;


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
$pageController = new Controllers();


$form = new Form();
$element = new htmlForm($form->getForm('inscription'),'inscription');
$layout = $element->createForm();

$pageController->setRawData('layout', $layout);
// $element1 = new htmlForm($form->getForm('post'),'post');
// $layout1 = $element1->createForm();

// $pageController->setRawData('layout1', $layout1);
$pageController->callThemeView('index');
// $options = $kdm->create('pp_option');
// echo'<pre style="background:#ffffff">';
// $options->findOptionName("sitedescription");
// var_dump( $options->getData() );
// echo'</pre>';

$user = new Users('');

//var_dump($user);
