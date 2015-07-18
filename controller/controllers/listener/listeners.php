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

if (count($_POST) < 1)
    Sophwork::redirectFromRef($_POST['pp-referer']);

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];

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
$_SESSION['form']['pp-referer'] = $url;

$KDM = new SophworkDM($app->config);

$page = $KDM->create('pp_page');
$page->findPageTag($optionPage);
$pageId = $page->getPageId()[0];

$re = "/(__)(.*)/";
foreach ($_POST as $key => $value) {
    if (preg_match($re, $key, $matches)) {
        $optionPage = $matches[2];
        break;
    }
}

/**
 * The value of optionPage will change if if the page do have a role
 * @var String
 */
$realPageName = $optionPage;

/**
 * Outside if above because this form is hardcoded
 * It will create a new comment after some verifications
 */
if($optionPage == 'comment'){
    if(!empty(trim(html_entity_decode(strip_tags(preg_replace("/&#?[a-z0-9]{2,8};/i","",$_POST['wysiwyg'])))))){
        $comment = $KDM->create('pp_comment');
        Users::startSession();
        $user = new Users();
    
        $comment->setComAuthor($user->id);
        $comment->setComContent($_POST['wysiwyg']);
        $comment->setComDate(date("Y-m-d H:i:s"));
        $comment->setComUpdate(date("Y-m-d H:i:s"));
        $comment->setComActive(1);
        $comment->setPostId($pageId);
        $comment->save();
        Sophwork::redirectFromRef($_POST['pp-referer']);
    }Sophwork::redirectFromRef($_POST['pp-referer']);
}

$pageMeta = $KDM->create('pp_pagemeta');

$page->findPageTag($optionPage);

if(is_null($page->getPageId()[0]))
    Sophwork::redirectFromRef($_POST['pp-referer']);

$pageMeta
    ->filterPageId($page->getPageId()[0])
    ->__and()
    ->filterPmetaName('role')
    ->querySelect();

$forms = $KDM->create('pp_form');
$forms->findFormName($optionPage);

$optionPage = $pageMeta->getPmetaValue()[0];

if ($forms->getFormId()[0] != null) {
    if ($optionPage == 'inscription' || $optionPage == 'connection') {
        $form = new Form();
        $arrayForm = $form->getForm($optionPage);
		$validator = new Validator();
		$msgError = $validator->validateForm($arrayForm, $_POST);
		$error = $msgError->msg;
        unset($_SESSION['form']['error']);

        $_SESSION['form']['submited'] = $_POST;
        if(isset($_SESSION['form']['submited']['password']))
            unset($_SESSION['form']['submited']['password']);
        if(isset($_SESSION['form']['submited']['validate_password']))
            unset($_SESSION['form']['submited']['validate_password']);

        if (!empty($error)) { //FIXME : check if the msg array is >0
            $_SESSION['form']['error'] = $error;
            /* AJAX check  */
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode($_SESSION['form']['error']);
                if(isset($_SESSION['form']['submited']))
                    unset($_SESSION['form']['submited']);
                if(isset($_SESSION['form']['error']))
                    unset($_SESSION['form']['error']);
                return;
            }
            Sophwork::redirect($realPageName);
            exit;
        } else {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode([]);
                if(isset($_SESSION['form']['submited']))
                    unset($_SESSION['form']['submited']);
                if(isset($_SESSION['form']['error']))
                    unset($_SESSION['form']['error']);
                return;
            }
            $_SESSION['form']['errorPage'] = Sophwork::getUrl($realPageName);
            $user = new Users();
            $user->$optionPage($_POST);
        }
    } else {
        // ...
    }
}

