<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];

$options = [
	'overview' => ['sitename', 'sitedescription', 'siteurl'],
	'pages' => '',
];

$sophwork = new Sophwork();
$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;

$optionPageController = preg_split("#/#", $_POST['pp-referer']);
	$optionPage = $optionPageController[count($optionPageController)-1];

$KDM = new SophworkDM($app->config);
foreach ($options[$optionPage] as $key => $value) {
	$$value = $KDM->create('pp_option');
		// Find if this property already exist, it will determine insert or update by the auto id
		$$value->findOne($value);
		
		$$value->setOptionName($value);
		$$value->setOptionValue($_POST[$value]);
		$$value->save();
}

// Redirect to the settings page from referer
Sophwork::redirectFromRef($_POST['pp-referer']);
exit;