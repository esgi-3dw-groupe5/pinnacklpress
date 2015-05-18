<?php
require('../../../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use controller\controllers\core\Controllers;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\utils\Users;
use controller\posts\Post;

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];

$sophwork = new Sophwork();
$app = new SophworkApp();
$controller = $app->appController;
$page = $controller->page;
$pageController = new Controllers();


$optionPageController = preg_split("#/#", $_POST['pp-referer']);

//var_dump($optionPageController);
/**
 *	Page
 */

$optionPage = $optionPageController[count($optionPageController)-1];//FIX ME : check if always 1st level page

var_dump($optionPage);

$KDM = new SophworkDM($app->config);

$forms = $KDM->create('pp_form');

$forms->findFormName($optionPage);


if($forms->getFormId()[0]!=null)
{
    if($optionPage=='inscription'||$optionPage=='connection')
    {
        $user = new Users();
        $user->$optionPage($_POST);
        var_dump($_SESSION);
    }

}

if(array_key_exists('__post', $_POST)){
	var_dump($_POST);
	$post = new Post();
	$post->createPost($_POST);
}