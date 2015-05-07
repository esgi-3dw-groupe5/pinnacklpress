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
if($optionPage == 'overview'){
	$KDM = new SophworkDM($app->config);
	foreach ($options[$optionPage] as $key => $value) {
		$$value = $KDM->create('pp_option');
			// Find if this property already exist, it will determine insert or update by the auto id
			$$value->findOne($value);
			
			$$value->setOptionName($value);
			$$value->setOptionValue($_POST[$value]);
			$$value->save();
	}	
}elseif($optionPage == 'formulaires'){

	var_dump($_POST);
	$formName = $_POST['form-name'];
	$KDM = new SophworkDM($app->config);
	$form = $KDM->create('pp_form');
	$form->findOne($formName);

	if(is_null($form->getData()['form_id'])){
		echo 'succes';
		//INSERT INTO FORM TABLE
		$form = $KDM->create('pp_form');
		$form->setFormName($_POST['form-name']);
		$form->setFormAction('');
		$form->setFormMethod('post');
		$form->setFormTarget('');
		$form->setFormEnctype('');
		
		//$form->save();
		$form->findOne($formName);

		//INSERT INTO FIELD TABLE
		
		foreach ($_POST as $key => $value) {
			var_dump($value);
			if(is_array($value)){
				$fieldName = $value['field-name']; // ok
				$fieldType = $value['field-type']; // ok
				$field = $KDM->create('pp_field');
				$field->setFieldName($fieldName);
				$field->setFieldType($fieldType);
				$field->setFieldDomname($fieldName);
				$field->setFieldDommid($fieldType);
				//$field->save();
				foreach ($value as $keyValidator => $valueValidator) {
					var_dump($keyValidator); // TO DO : get validation
				}
			}
		}
		

	}
	else{
		echo 'echec';
	}
	exit;
}

// Redirect to the settings page from referer
Sophwork::redirectFromRef($_POST['pp-referer']);
exit;