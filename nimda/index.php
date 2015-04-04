<?php
require('../sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;
use sophwork\app\controller\FormController;

use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;
use controller\form\Field;

$sophwork = new Sophwork();
	$sophwork->setHtaccess('pinnacklpress/nimda', dirname(__FILE__));
$app = new SophworkApp();
	$app->appName='Pinnackl Press';
$controller = $app->appController;
	$page = $controller->page;
$controller->formController = new FormController();

$KDM = new SophworkDM($app->config);

$nameField = $KDM->create('pp_field');
$nameField->setFieldName('nimda-site-name');
$nameField->setFieldType('text');
$nameField->setFieldDomname('name');
$nameField->setFieldDomid('name');
$nameField->setFieldPlaceholder('Site name');

$descriptionField = $KDM->create('pp_field');
$descriptionField->setFieldName('nimda-site-description');
$descriptionField->setFieldType('text');
$descriptionField->setFieldDomname('description');
$descriptionField->setFieldDomid('description');
$descriptionField->setFieldPlaceholder('Description');

$addressField = $KDM->create('pp_field');
$addressField->setFieldName('nimda-site-address');
$addressField->setFieldType('url');
$addressField->setFieldDomname('address');
$addressField->setFieldDomid('address');
$addressField->setFieldValue($sophwork::getUrl());
$addressField->setFieldPlaceholder('Site name');

// FIXME : handle the form post and save it into the database

if($page == 'index')
	Sophwork::redirect('nimda/overview');
$loader = new SophworkTELoader();
$template = $loader->loadFromFile("template/header.tpl");
$KTE = new SophworkTEParser($template, [
	'title' => 'Nimda',
	'menu' => ['Overview','Page'],
	'active' => ['active'],
]);
print $KTE->parseTemplate();

$template = $loader->loadFromFile("template/". $page .".tpl");
$KTE = new SophworkTEParser($template, [
	'h1' => 'Pinnackl Press',
	'h2' => 'Global configuration',
	'legend' => 'Site configuation',
	// input-1
	'label_1' => $nameField->getFieldPlaceholder(),
	'input_1' => $nameField->getFieldDomname(),
	'type_1' => $nameField->getFieldType(),
	// input-2
	'label_2' => $descriptionField->getFieldPlaceholder(),
	'input_2' => $descriptionField->getFieldDomname(),
	'type_2' => $descriptionField->getFieldType(),
	// input-3
	'label_3' => $addressField->getFieldPlaceholder(),
	'input_3' => $addressField->getFieldDomname(),
	'type_3' => $addressField->getFieldType(),
	'value_3' => $addressField->getFieldValue(),
]);
print $KTE->parseTemplate();

echo '</div></body></html>'; // Layout


// debug
// echo'<pre>';
// // var_dump($app);
// // var_dump($controller);
// // var_dump($page);
// echo'</pre>';