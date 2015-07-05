<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__ . '/../sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

use controller\controllers\core\Controllers;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

if(file_exists('pinnacklpress.php'))
	Sophwork::redirect('nimda');

$app = new SophworkApp();
$appController = $app->appController;

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
		$user = $appController->KDM->create('pp_user');
		if($_POST['password'] == $_POST['confirm']){
			$user->setUserEmail($_POST['email']);
			$user->setUserPseudo($_POST['pseudo']);
			$user->setUserPassword(md5($_POST['password']));
			$user->setUserRole('administrator');
			$user->setUserActive('1');
			$user->setUserUrl($_POST['pseudo']);
			$user->setUserKey(md5(microtime().rand()));
			$user->save();
			Sophwork::redirect('install/settings');
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
		$option->setOptionValue(null);
		$option->save();

		$option = $appController->KDM->create('pp_option');
		$option->findOptionName('theme');
		$option->setOptionName('theme');
		$option->setOptionValue('pure');
		$option->save();

		$option = $appController->KDM->create('pp_option');
		$option->findOptionName('sidebar');
		$option->setOptionName('sidebar');
		$option->setOptionValue(null);
		$option->save();
		
		$page = $appController->KDM->create('pp_page');
		$page->setPageTag('index');
		$page->setPageName('Index');
		$page->setPageConnectedAs('visitor');
		$page->setPageType('page');
		$page->setPageStatus('publish');
		$page->setPageCommentStatus('disable');
		$page->setPageDate(date("Y-m-d h:i:s"));
		$page->setPageOrder(0);
		$page->setPageLevel(1);
		$page->setPageParent(0);
		$page->save();

		$pageContent = $appController->KDM->create('pp_pagemeta');
		$pageContent->setPageId(1);
		$pageContent->setPmetaName('content');
		$pageContent->setPmetaValue('[{"line":[{"gridClass":"grid-4_4","gridModule":"[text]","gridContent":"<h1>Welcome to Pinnackl Press.</h1><p><br></p><p>Thanks you for using our CMS.</p><p>We build this tool to let you manange easily your contents and create a powerful web site.<br></p>"}]}]');
		$pageContent->save();

		$menu = $appController->KDM->create('pp_menu');
		$menu->setMenuName('main');
		$menu->setMenuStatus('primary');
		$menu->save();

		$menuRs = $appController->KDM->create('pp_menu_rs');
		$menuRs->setMenuId(1);
		$menuRs->setPageId(1);
		$menuRs->save();

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