<?php
require('../../../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use controller\controllers\core\Controllers;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\form\Form;
use controller\form\Validator;
use controller\utils\Users;
use controller\posts\Post;

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];

$sophwork = new Sophwork();
$app = new SophworkApp();
$controller = $app->appController;
$page = $controller->page;
$pageController = new Controllers();


$optionPageController = preg_split("#/#", $_POST['pp-referer']);

/**
 *	Page
 */

$optionPage = $optionPageController[count($optionPageController)-1];//FIX ME : check if always 1st level page
$url = implode('/', $optionPageController);
$_SESSION['form']['pp-referer']=$url;

var_dump($optionPage);

$KDM = new SophworkDM($app->config);

$forms = $KDM->create('pp_form');

$forms->findFormName($optionPage);

if($forms->getFormId()[0]!=null){
    if($optionPage == 'inscription' || $optionPage == 'connection'){
		$form = new Form();
		$arrayForm = $form->getForm($optionPage);
		$validator = new Validator();
		$msgError = $validator->validateForm($arrayForm,$_POST);
		$error = $msgError->msg;
        if(!empty($error)){//FIXME : check if the msg array is >0
            $_SESSION['form']['error'] = $error;
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($url);
            exit;
                      
        }
        else{
            $user = new Users();
            $user->$optionPage($_POST);
        }
    }
}