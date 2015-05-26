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
		'overview' => ['sitename', 'sitedescription', 'siteurl', 'theme'],
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
	if($edit == '') $edit = 0;
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findPageId($edit);

	$pageCotent = $KDM->create('pp_pagemeta');
	$pageCotent->findPageId($page->getPageId()[0]);
	if(array_key_exists('pageBuilder', $_POST)){
		$pageCotent->setPageId($page->getPageId());
		$pageCotent->setPmetaName('content');
		$pageCotent->setPmetaValue($_POST['pageBuilder']);
		$pageCotent->save();

		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();
	}
	if(!array_key_exists('pageBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageOrder($_POST['page_order']);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
		$page->setPageStatus($_POST['page_status']);
		$page->setPageCommentStatus($_POST['page_comment_status']);
		$page->setPageType('page');
		if(in_array('new', $optionPageController))
			$page->setPageDate(date('Y-m-d H:i:s', strtotime("now")));
		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
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

elseif($optionPage == 'posts'){
	if($edit == '') $edit = 0;
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findPageId($edit);

	if(array_key_exists('postBuilder', $_POST)){
		// catergories
	}
	if(!array_key_exists('postBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageOrder($_POST['page_order']);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
		$page->setPageStatus($_POST['page_status']);
		$page->setPageCommentStatus($_POST['page_comment_status']);
		$page->setPageType('post');
		$page->setPageCommentCount(0); // check if update
		$page->setPageParent(0);		// checkif update
		if(in_array('new', $optionPageController))
			$page->setPageDate(date('Y-m-d H:i:s', strtotime("now")));
		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();

		$pageCotent = $KDM->create('pp_pagemeta');
		$pageCotent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('content')
			->querySelect();

		$pageCotent->setPageId($page->getPageId()[0]);
		$pageCotent->setPmetaName('content');
		$pageCotent->setPmetaValue($_POST['wysiwyg']); //create content object
		$pageCotent->save();

		$pageCategories = $KDM->create('pp_pagemeta');
		$pageCategories
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('category')
			->querySelect();

		if(is_array($pageCategories->getPageId())){
			$linked = $KDM->create('pp_pagemeta');
			foreach ($pageCategories->getPmetaId() as $key => $value) {
				$linked->findOne($value);
				if(isset($_POST['pages']) && is_array($_POST['pages'])){
					foreach ($_POST['pages'] as $key => $value) {
						if(!in_array($linked->getPageId(), $_POST['pages'])){
							$linked->erase();
						}
					}
				}
				else{
					$linked->erase();
				}
			}
			foreach ($_POST['categories'] as $key => $value) {
				if(!in_array($value, $pageCategories->getPageId())){
					$added = $KDM->create('pp_pagemeta');
					$added->setPageId($page->getPageId()[0]);
					$added->setPmetaName('category');
					$added->setPmetaValue($value);
					$added->save();
				}
			}
		}
		else{
			foreach ($_POST['categories'] as $key => $value) {
				$pageCategories = $KDM->create('pp_pagemeta');
				$pageCategories->setPageId($page->getPageId()[0]);
				$pageCategories->setPmetaName('category');
				$pageCategories->setPmetaValue($value);
				$pageCategories->save();
			}
		}
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

elseif($optionPage == 'catergories'){

}

elseif($optionPage == 'menus'){
	$KDM = new SophworkDM($app->config);
	$menu = $KDM->create('pp_menu');
	$menu->findOne($edit);
	if(array_key_exists('menuBuilder', $_POST)){
		$menuRs = $KDM->create('pp_menu_rs');
		$menuRs->findMenuId($menu->getMenuId());
		
		if(is_array($menuRs->getMenuRsId())){
			$linked = $KDM->create('pp_menu_rs');
			foreach ($menuRs->getMenuRsId() as $key => $value) {
				$linked->findOne($value);

				if(isset($_POST['pages']) && is_array($_POST['pages'])){
					foreach ($_POST['pages'] as $key => $value) {
						if(!in_array($linked->getPageId(), $_POST['pages'])){
							$linked->erase();
						}
					}
				}
				else{
					$linked->erase();
				}
			}
			foreach ($_POST['pages'] as $key => $value) {
				if(!in_array($value, $menuRs->getPageId())){
					$added = $KDM->create('pp_menu_rs');
					$added->setMenuId($menu->getMenuId());
					$added->setPageId($value);
					$added->save();
				}
			}
		}
		else{
			foreach ($_POST['pages'] as $key => $value) {
				$menuRs = $KDM->create('pp_menu_rs');
				$menuRs->setMenuId($menu->getMenuId());
				$menuRs->setPageId($value);
				$menuRs->save();
			}
		}
	}
	if(!array_key_exists('menuBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case
		$menu->setMenuName($_POST['menu_name']);
		$menu->setMenuStatus(strtolower($_POST['menu_status']));
		$menu->save();
	}
	if(in_array('new', $optionPageController)){
		$optionPageController[count($optionPageController)-1] = $menu->getMenuId();
		$optionPageController[count($optionPageController)-2] = 'edit';
		$url = implode('/', $optionPageController);
		Sophwork::redirectFromRef($url);
		exit;
	}
	if(in_array('delete', $optionPageController)){
		$menu->erase();
		Sophwork::redirect('nimda/menus');
		exit;
	}
}

elseif($optionPage == 'forms'){

	$formName = $_POST['form-name'];
	$KDM = new SophworkDM($app->config);
	$form = $KDM->create('pp_form');
	$form->findOne($formName);

	if(in_array('delete', $optionPageController)){
		$form->erase();
		Sophwork::redirect('nimda/forms');
		exit;
	}

	if(in_array('new', $optionPageController)){
		$optionPageController[count($optionPageController)-1] = $page->getPageId();
		$optionPageController[count($optionPageController)-2] = 'edit';
		$url = implode('/', $optionPageController);
		Sophwork::redirectFromRef($url);
		exit;
	}
	
	if(is_null($form->getData()['form_id'])){

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
