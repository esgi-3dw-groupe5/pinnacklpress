<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
$pageController->callView('index');
// $options = $kdm->create('pp_option');
// echo'<pre style="background:#ffffff">';
// $options->findOptionName("sitedescription");
// var_dump( $options->getData() );
// echo'</pre>';

$user = new Users('');

//var_dump($user);
