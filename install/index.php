<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__ . '/../sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

use controller\controllers\core\Controllers;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use nimda\mail\Mail;

if(file_exists('pinnacklpress.php'))
    Sophwork::redirect('nimda');

$app = new SophworkApp();
$appController = $app->appController;

$mail = new Mail();

// Set global variables
$siteUrl = Sophwork::getUrl();
$appController->setViewData('siteUrl', $siteUrl);

// get the config form data
if(sizeof($_POST) > 0){
    if(isset($_POST['pp_dbConfig'])){
        $appController->KDM = new SophworkDM($_POST);
        if(is_object($appController->KDM->link)){
            Sophwork::setConfig($_POST);
            $link = $appController->KDM->link;
            require_once __DIR__ . '/../database/pinnacklpress_db.php';
            Sophwork::redirect('install/user');
        }
    }
    elseif(isset($_POST['pp_adConfig'])){
        $appController->KDM = new SophworkDM(Sophwork::getConfig());
        
        $option = $appController->KDM->create('pp_option');
        $option->setOptionName('smtp_email');
        $option->setOptionValue($_POST['smtp_email']);
        $option->save();
        
        $option = $appController->KDM->create('pp_option');
        $option->setOptionName('smtp_host');
        $option->setOptionValue($_POST['smtp_host']);
        $option->save();
        
        $option = $appController->KDM->create('pp_option');
        $option->setOptionName('smtp_auth');
        $option->setOptionValue($_POST['smtp_auth']);
        $option->save();
        
        if($_POST['smtp_auth']=='true') {
            $option = $appController->KDM->create('pp_option');
            $option->setOptionName('smtp_username');
            $option->setOptionValue($_POST['smtp_username']);
            $option->save();
            
            $option = $appController->KDM->create('pp_option');
            $option->setOptionName('smtp_password');
            $option->setOptionValue($_POST['smtp_password']);
            $option->save();
            
            $option = $appController->KDM->create('pp_option');
            $option->setOptionName('smtp_port');
            $option->setOptionValue($_POST['smtp_port']);
            $option->save();
        }
        
        $user = $appController->KDM->create('pp_user');
        if($_POST['password'] == $_POST['confirm']){
            $hash_psw = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user->setUserEmail($_POST['email']);
            $user->setUserPseudo($_POST['pseudo']);
            $user->setUserPassword($hash_psw);
            $user->setUserRegdate(date("Y-m-d h:i:s"));
            $user->setUserRole('superadmin');
            $user->setUserActive('1');
            $user->setUserUrl($_POST['pseudo']);
            $user->setUserKey(md5(microtime().rand()));
            $user->save();
            
            $mail->sendMail($_POST['pseudo'],$_POST['email'],'install',$cle=null);

        }
        else{
            echo'<div style="background:#df1f1f;color:#fff;padding:0 5px;box-sizing:border-box;">';
            echo'<h2>The two passwords entered do not match</h2>';
            echo'</div>';
        }
    }
    elseif(isset($_POST['pp_settings'])){
        $appController->KDM = new SophworkDM(Sophwork::getConfig());

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('sitename');
        $option->setOptionName('sitename');
        $option->setOptionValue( empty($_POST['sitename'])?'':$_POST['sitename'] );
        $option->save();

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('sitedescription');
        $option->setOptionName('sitedescription');
        $option->setOptionValue( empty($_POST['sitedescription'])?'':$_POST['sitedescription'] );
        $option->save();

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('siteurl');
        $option->setOptionName('siteurl');
        $option->setOptionValue($_POST['siteurl']);
        $option->save();

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('permalink');
        $option->setOptionName('permalink');
        $option->setOptionValue('custom');
        $option->save();

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('theme');
        $option->setOptionName('theme');
        $option->setOptionValue('pure');
        $option->save();

        $option = $appController->KDM->create('pp_option');
        $option->findOptionName('sidebar');
        $option->setOptionName('sidebar');
        $option->setOptionValue('on');
        $option->save();

        $page = $appController->KDM->create('pp_page');
        $page->setPageTag('index');
        $page->setPageName('Index');
        $page->setPageConnectedAs('visitor');
        $page->setPageType('page');
        $page->setPageStatus('publish');
        $page->setPageAuthor(1);
        $page->setPageCommentStatus('disable');
        $page->setPageDate(date("Y-m-d h:i:s"));
        $page->setPageOrder(1);
        $page->setPageLevel(1);
        $page->setPageParent(0);
        $page->save();

        $page = $appController->KDM->create('pp_page');
        $page->setPageTag('inscription');
        $page->setPageName('Inscription');
        $page->setPageConnectedAs('visitor');
        $page->setPageType('page');
        $page->setPageStatus('publish');
        $page->setPageAuthor(1);
        $page->setPageCommentStatus('disable');
        $page->setPageDate(date("Y-m-d h:i:s"));
        $page->setPageOrder(2);
        $page->setPageLevel(1);
        $page->setPageParent(0);
        $page->save();
        
        $page = $appController->KDM->create('pp_page');
        $page->setPageTag('connection');
        $page->setPageName('Connection');
        $page->setPageConnectedAs('visitor');
        $page->setPageType('page');
        $page->setPageStatus('publish');
        $page->setPageAuthor(1);
        $page->setPageCommentStatus('disable');
        $page->setPageDate(date("Y-m-d h:i:s"));
        $page->setPageOrder(3);
        $page->setPageLevel(1);
        $page->setPageParent(0);
        $page->save();


        $pageContent = $appController->KDM->create('pp_pagemeta');
        $pageContent->setPageId(1);
        $pageContent->setPmetaName('content');
        $pageContent->setPmetaValue('[{"line":[{"gridClass":"grid-4_4","gridModule":"[text]","gridContent":"<h1>Welcome to Pinnackl Press.</h1><p><br></p><p>Thanks you for using our CMS.</p><p>We build this tool to let you manange easily your contents and create a powerful web site.<br></p>"}]}]');
        $pageContent->save();

        $pageContent = $appController->KDM->create('pp_pagemeta');
        $pageContent->setPageId(2);
        $pageContent->setPmetaName('content');
        $pageContent->setPmetaValue('[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"inscription"}]}]');
        $pageContent->save();

        $pageContent = $appController->KDM->create('pp_pagemeta');
        $pageContent->setPageId(2);
        $pageContent->setPmetaName('role');
        $pageContent->setPmetaValue('inscription');
        $pageContent->save();
        
        $pageContent = $appController->KDM->create('pp_pagemeta');
        $pageContent->setPageId(3);
        $pageContent->setPmetaName('content');
        $pageContent->setPmetaValue('[{"line":[{"gridClass":"grid-4_4","gridModule":"[form]","gridContent":"connection"}]}]');
        $pageContent->save();
        
        $pageContent = $appController->KDM->create('pp_pagemeta');
        $pageContent->setPageId(3);
        $pageContent->setPmetaName('role');
        $pageContent->setPmetaValue('connection');
        $pageContent->save();

        $menu = $appController->KDM->create('pp_menu');
        $menu->setMenuName('main');
        $menu->setMenuStatus('primary');
        $menu->save();

        $menuRs = $appController->KDM->create('pp_menu_rs');
        $menuRs->setMenuId(1);
        $menuRs->setPageId(1);
        $menuRs->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('email');
        $field->setFieldType('email');
        $field->setFieldDomname('email');
        $field->setFieldDomid('email');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('password');
        $field->setFieldType('password');
        $field->setFieldDomname('password');
        $field->setFieldDomid('password');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('email');
        $field->setFieldType('email');
        $field->setFieldDomname('email');
        $field->setFieldDomid('email');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('pseudo');
        $field->setFieldType('text');
        $field->setFieldDomname('pseudo');
        $field->setFieldDomid('text');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('password');
        $field->setFieldType('password');
        $field->setFieldDomname('password');
        $field->setFieldDomid('password');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('firstname');
        $field->setFieldType('text');
        $field->setFieldDomname('firstname');
        $field->setFieldDomid('text');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('lastname');
        $field->setFieldType('text');
        $field->setFieldDomname('lastname');
        $field->setFieldDomid('text');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $field = $appController->KDM->create('pp_field');
        $field->setFieldName('birthdate');
        $field->setFieldType('date');
        $field->setFieldDomname('birthdate');
        $field->setFieldDomid('date');
        $field->setFieldValue('');
        $field->setFieldPlaceholder('');
        $field->save();

        $fieldRs = $field = $appController->KDM->create('pp_field_rs');
        $fieldRs->setFieldId(3);
        $fieldRs->setValidatorId(1);
        $fieldRs->save();

        $fieldRs = $field = $appController->KDM->create('pp_field_rs');
        $fieldRs->setFieldId(5);
        $fieldRs->setValidatorId(2);
        $fieldRs->save();

        $fieldRs = $appController->KDM->create('pp_field_rs');
        $fieldRs->setFieldId(8);
        $fieldRs->setValidatorId(3);
        $fieldRs->save();

        $form = $appController->KDM->create('pp_form');
        $form->setFormName('connection');
        $form->setFormAction('');
        $form->setFormMethod('post');
        $form->setFormTarget('');
        $form->setFormEnctype('');
        $form->save();

        $form = $appController->KDM->create('pp_form');
        $form->setFormName('inscription');
        $form->setFormAction('');
        $form->setFormMethod('post');
        $form->setFormTarget('');
        $form->setFormEnctype('');
        $form->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(1);
        $formRs->setFieldId(1);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(1);
        $formRs->setFieldId(2);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(3);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(4);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(5);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(6);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(7);
        $formRs->save();

        $formRs = $appController->KDM->create('pp_form_rs');
        $formRs->setFormId(2);
        $formRs->setFieldId(8);
        $formRs->save();

        $validator = $appController->KDM->create('pp_validator');
        $validator->setValidatorRule('isMail');
        $validator->save();

        $validator = $appController->KDM->create('pp_validator');
        $validator->setValidatorRule('isPassword');
        $validator->save();

        $validator = $appController->KDM->create('pp_validator');
        $validator->setValidatorRule('isDate');
        $validator->save();

        $handle = fopen('pinnacklpress.php', "w+");
        $text = date("l jS \of F Y h:i:s A");
        fwrite($handle, $text);
        fclose($handle);
        
        Sophwork::redirect('nimda');

    }
}
if($appController->page == 'index')
    Sophwork::redirect('install/config');
$appController->callView($appController->page);