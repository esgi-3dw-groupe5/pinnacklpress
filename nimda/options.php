<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

$_POST['pp-referer'] = $_SERVER['HTTP_REFERER'];


$sophwork = new Sophwork();
$app = new SophworkApp();
$controller = $app->appController;
	$page = $controller->page;

$optionPageController = preg_split("#/#", $_POST['pp-referer']);
/**
 *	Page
 */
if(in_array('edit', $optionPageController) 
	|| in_array('new', $optionPageController) 
	|| in_array('delete', $optionPageController)){ //FIXME : IS the level will alaway be 3 ?
	$optionPage = $optionPageController[count($optionPageController)-3];
	$edit = $optionPageController[count($optionPageController)-1];
}
else{
	$optionPage = $optionPageController[count($optionPageController)-1];
	$edit = $optionPageController[count($optionPageController)-1];
}

if($optionPage == 'overview'){
	$options = [
		'overview' => ['sitename', 'sitedescription', 'siteurl'],
	];
	$KDM = new SophworkDM($app->config);
	foreach ($options[$optionPage] as $key => $value) {
		$$value = $KDM->create('pp_option');
			// Find if this property already exist, it will determine insert or update by the auto id
			$$value->findOne($value);
			
			$$value->setOptionName($value);
			$$value->setOptionValue($_POST[$value]);
			$$value->save();
	}	
}

elseif($optionPage == 'pages'){
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findOne($edit);
	if(array_key_exists('pageBuilder', $_POST)){
		$pageCotent = $KDM->create('pp_pagemeta');
		$pageCotent->findPageId($page->getPageId());

		$pageCotent->setPageId($page->getPageId());
		$pageCotent->setPmetaName('content');
		$pageCotent->setPmetaValue($_POST['pageBuilder']);
		$pageCotent->save();
	}
	if(!array_key_exists('pageBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){
		$page->setPageTag($_POST['page_tag']);
		$page->setPageName($_POST['page_name']);
		$page->setPageOrder($_POST['page_order']);
		$page->setPageDisplay($_POST['page_display']);
		$page->setPageConnected($_POST['page_connected']);
		$page->setPageActive($_POST['page_active']);
		$page->setPageType($_POST['page_type']);
		$page->save();
	}
	if(in_array('new', $optionPageController)){
		$optionPageController[count($optionPageController)-1] = $page->getPageId();
		$optionPageController[count($optionPageController)-2] = 'edit';
		$url = implode('/', $optionPageController);
		Sophwork::redirectFromRef($url);
		exit;
	}
	if(in_array('delete', $optionPageController)){
		$page->erase();
		Sophwork::redirect('nimda/pages');
		exit;
	}
}

elseif($optionPage == 'formulaires'){

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
		
		$form->save();
		$idForm = $form->getData()['form_id'];

		//INSERT INTO FIELD TABLE
		
		foreach ($_POST as $key => $value) {
			if(is_array($value)){
				$fieldName = $value['field-name']; 
				$fieldType = $value['field-type']; 
				$field = $KDM->create('pp_field');
				$field->setFieldName($fieldName);
				$field->setFieldType($fieldType);
				$field->setFieldDomname($fieldName);
				$field->setFieldDomid($fieldType);
				$field->setFieldValue("");
				$field->setFieldPlaceholder("");
				$field->save();
				$idField = $field->getData()['field_id'];

				//INSERT INTO FORM RS

				$formRs = $KDM->create('pp_form_rs');
				$formRs->setFormId($idForm);
				$formRs->setFieldId($idField);
				$formRs->save();

				$incr = 0;
				foreach ($value as $keyValidator => $valueValidator) {
					$incr++;
					if($incr>2){
						$rule = "is".ucfirst($keyValidator);
						$validator = $KDM->create('pp_validator');
						$validator->setValidatorRule($rule);
						$validator->save();
						$idValidator = $validator->getData()['validator_id'];

						//INSERT INTO FIELD RS

						$fieldRs = $KDM->create('pp_field_rs');
						$fieldRs->setFieldId($idField);
						$fieldRs->setValidatorId($idValidator);
						$fieldRs->save();
					}
				}
			}
		}
	}
	else{
		echo 'echec';
	}
}

// Redirect to the settings page from referer
Sophwork::redirectFromRef($_POST['pp-referer']);
