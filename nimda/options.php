<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\utils\Users;

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

if($optionPage == 'pages'){
	if($edit == '') $edit = 0; // in case of nothing to find, search for somethig that doesn't exist
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findPageId($edit);

	$pageContent = $KDM->create('pp_pagemeta');
	$pageContent->findPageId($page->getPageId()[0]);

	Users::startSession();
	$user = new Users();

	if(array_key_exists('pageBuilder', $_POST)){
		$pageContent->setPageId($page->getPageId()[0]);
		$pageContent->setPmetaName('content');
		$pageContent->setPmetaValue($_POST['pageBuilder']);
		$pageContent->save();

		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();

		echo '#updated';
		return;
	}
	if(!array_key_exists('pageBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageAuthor($user->id);
		$page->setPageOrder($_POST['page_order']);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
		$page->setPageStatus($_POST['page_status']);
		$page->setPageCommentStatus($_POST['page_comment_status']);
		if(array_key_exists('page_articles', $_POST)){
			$page->setPageType('article');
		}else{
			$page->setPageType('page');
		}	
        $page->setPageLevel(1);
        $page->setPageParent(0);
		if(in_array('new', $optionPageController))
			$page->setPageDate(date('Y-m-d H:i:s', strtotime("now")));
		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();

		$pageContent = $KDM->create('pp_pagemeta');
		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('role')
			->querySelect();
		$pageContent->setPageId($page->getPageId());
		$pageContent->setPmetaName('role');
		$pageContent->setPmetaValue($_POST['page_role']);
		$pageContent->save();
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

	Users::startSession();
	$user = new Users();

	if(array_key_exists('postBuilder', $_POST)){
		// catergories
	}
	if(!array_key_exists('postBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageAuthor($user->id);
		$page->setPageOrder($_POST['page_order']);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
		$page->setPageStatus($_POST['page_status']);
		$page->setPageCommentStatus($_POST['page_comment_status']);
		$page->setPageType('post');
		$page->setPageCommentCount(0); // check if update
		$page->setPageParent(0);		// checkif update
        $page->setPageLevel(1);
		if(in_array('new', $optionPageController))
			$page->setPageDate(date('Y-m-d H:i:s', strtotime("now")));
		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();

		$pageId = $page->getData()['page_id'];

		
		if (file_exists("../data/articles/temp/".$user->id.'/')){
			$source = '../data/articles/temp/'.$user->id.'/';

			if (count(glob($source)) <= 0 ){

				$files = scandir($source);
	
				if (!file_exists("../data/articles/".$pageId)){
				    mkdir("../data/articles/".$pageId);
				}
		
				$destination = '../data/articles/'.$pageId.'/';
		
				foreach ($files as $file) {
				  if (in_array($file, array(".",".."))) continue;
				  // If we copied this successfully, mark it for deletion
				  if (copy($source.$file, $destination.$file)) {
				    $delete[] = $source.$file;
				  }
				}
				// Delete all successfully-copied files
				foreach ($delete as $file) {
				  unlink($file);
				}
			}
		}

		$pageContent = $KDM->create('pp_pagemeta');
		$pageContent
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('content')
			->querySelect();

		$pageContent->setPageId($page->getPageId()[0]);
		$pageContent->setPmetaName('content');
		// content system
		$contentSys = [
			(object)[
				'line' => [
					(object)[
						'gridClass' => 'grid-4_4',
						'gridModule' => 'text',
						'gridContent' => $_POST['wysiwyg'],
					],
				],
			],
		];
		$pageContent->setPmetaValue(json_encode($contentSys)); //create content object
		$pageContent->save();

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
		Sophwork::redirect('nimda/posts');
		exit;
	}
}

elseif($optionPage == 'categories'){
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findPageId($edit);

	Users::startSession();
	$user = new Users();

	if(!array_key_exists('categoryBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageType('category');
		$page->setPageAuthor($user->id);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
        $page->setPageStatus('publish');
        $page->setPageCommentStatus('disable');
        $page->setPageLevel(1);
        $page->setPageParent(0);
		$page->save();


		$pageCategories = $KDM->create('pp_pagemeta');
		$pageCategories
			->filterPageId($page->getPageId()[0])
			->__and()
			->filterPmetaName('category')
			->querySelect();

		if(is_array($pageCategories->getPageId())){
			$linked = $KDM->create('pp_pagemeta');
			foreach ($pageCategories->getPmetaId() as $key => $value) {
				$linked->findPageId($value);
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
		Sophwork::redirect('nimda/categories');
		exit;
	}
}

elseif($optionPage == 'comments'){
	$KDM = new SophworkDM($app->config);
	$comment = $KDM->create('pp_comment');
	$comment->findComId($edit);
	if(!in_array('delete', $optionPageController) && !array_key_exists('statusBuilder', $_POST)){ //handle edit and new case

		$comment->setComContent($_POST['com_content']);
		$comment->setComActive($_POST['com_active']);
		$comment->save();

	}
	if(in_array('delete', $optionPageController)){
		$comment->erase();
		Sophwork::redirect('nimda/comments');
		exit;
	}
	if(array_key_exists('statusBuilder', $_POST)){
		foreach ($_POST['statusBuilder'] as $key => $nodes) {
			$comment->findComId($nodes['id']);
			$comment->setComActive($nodes['status']);
			$comment->save();
		}
	echo '#updated';
	return;
	}
}

elseif($optionPage == 'menus'){
	$KDM = new SophworkDM($app->config);
	$menu = $KDM->create('pp_menu');
	$menu->findMenuId($edit);
	$pages = $KDM->create('pp_page');
	if(array_key_exists('menuBuilder', $_POST)){
		$menuRs = $KDM->create('pp_menu_rs');
		$menuRs->findMenuId($menu->getMenuId()[0]);

		if(is_array($menuRs->getMenuRsId())){
			$linked = $KDM->create('pp_menu_rs');
			foreach ($menuRs->getMenuRsId() as $key => $value) {
				$linked->findOne($value); // potential error, check for table keys

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
					$added->setMenuId($menu->getMenuId()[0]);
					$added->setPageId($value);
					$added->save();
				}
			}
		}
		else{
			foreach ($_POST['pages'] as $key => $value) {
				$menuRs = $KDM->create('pp_menu_rs');
				$menuRs->setMenuId($menu->getMenuId()[0]);
				$menuRs->setPageId($value);
				$menuRs->save();
			}
		}
	}
	if(array_key_exists('nodesBuilder', $_POST)){
		foreach ($_POST['nodesBuilder'] as $key => $nodes) {
			$pages->findPageId($nodes['id']);
			$pages->setPageOrder($nodes['dataOrder']);
			$pages->setPageLevel($nodes['dataLv']);
			$pages->setPageParent($nodes['dataParent']);
			$pages->save();
		}
		echo '#updated';
		return;
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

elseif($optionPage == 'footers'){
	if($edit == '') $edit = 0;
	$KDM = new SophworkDM($app->config);
	$page = $KDM->create('pp_page');
	$page->findPageId($edit);

	$pageContent = $KDM->create('pp_pagemeta');
	$pageContent->findPageId($page->getPageId()[0]);
	if(array_key_exists('pageBuilder', $_POST)){
		$pageContent->setPageId($page->getPageId());
		$pageContent->setPmetaName('footer');
		$pageContent->setPmetaValue($_POST['pageBuilder']);
		$pageContent->save();

		$page->setPageUdate(date('Y-m-d H:i:s', strtotime("now")));
		$page->save();

		echo '#updated';
		return;
	}
	if(!array_key_exists('pageBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){ //handle edit and new case

		$page->setPageTag(Sophwork::slug($_POST['page_name']));
		$page->setPageName($_POST['page_name']);
		$page->setPageConnectedAs($_POST['page_connectedAs']);
		$page->setPageStatus($_POST['page_status']);
		$page->setPageType('footer');
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

elseif($optionPage == 'forms'){
	if($edit == '') $edit = 0;
	$formName = $_POST['form-name'];
	$KDM = new SophworkDM($app->config);
	$form = $KDM->create('pp_form');
	$form->findOne($edit);

	if(!array_key_exists('categoryBuilder', $_POST)
		&& !in_array('delete', $optionPageController)){


		//INSERT INTO FORM TABLE
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
				if(array_key_exists('field-name-'.$key, $_POST)){
					$fieldName = $_POST['field-name-'.$key];
				    $_POST['field-name-'+$key]['field-name'] = $fieldName;
				}				
			}
		}
		foreach ($_POST as $key => $value) {
			if(is_array($value)){

				$fieldName = $value['field-name']; 
				$fieldType = $value['field-type']; 
				$field = $KDM->create('pp_field');
				$field->findOne($value['field-id']);
				$field->setFieldName($fieldName);
				$field->setFieldType($fieldType);
				$field->setFieldDomname($fieldName);
				$field->setFieldDomid($fieldType);
				$field->setFieldValue("");
				$field->setFieldPlaceholder("");
				$field->save();
				$idField = $field->getData()['field_id'];

				//INSERT INTO FORM RS
				if($edit == 0){
					$formRs = $KDM->create('pp_form_rs');
					$formRs->setFormId($idForm);
					$formRs->setFieldId($idField);
					$formRs->save();
				}
				

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

	if(in_array('delete', $optionPageController)){
		$form->erase();
		Sophwork::redirect('nimda/forms');
		exit;
	}

	if(in_array('new', $optionPageController)){
		$optionPageController[count($optionPageController)-1] = $form->getFormId();
		$optionPageController[count($optionPageController)-2] = 'edit';
		$url = implode('/', $optionPageController);
		Sophwork::redirectFromRef($url);
		exit;
	}
}

else if($optionPage == 'settings'){
	$options = [
		'settings' => ['sitename', 'sitedescription', 'siteurl', 'permalink', 'smtp_email', 'smtp_host'],
	];
	$KDM = new SophworkDM($app->config);
	foreach ($options[$optionPage] as $key => $value) {
		$$value = $KDM->create('pp_option');
			// Find if this property already exist, it will determine insert or update by the auto id
			$$value->findOne($value);

			$$value->setOptionName($value);
			$$value->setOptionValue($_POST[$value]);
			if($value == 'permalink'
				&& $_POST['permalink-i'] != ""
				&& $_POST['permalink'] == 'custom')
				$$value->setOptionValue($_POST['permalink-i']);
			$$value->save();
	}
}

else if($optionPage == 'themes'){
	$options = [
		'themes' => ['theme', 'sidebar'],
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


else if($optionPage == 'users' || $optionPage == 'info'){
	if($edit == '') $edit = 0;
	$KDM = new SophworkDM($app->config);
	$user = $KDM->create('pp_user');
	$user->findUserId($edit);

	if($edit == 'info'){
		$pseudo = $optionPageController[count($optionPageController)-2];
		$user->findUserPseudo($pseudo);
	}

	if(!in_array('delete', $optionPageController)){ //handle edit and new case
		
		//var_dump($user->filterUserPseudo($_POST['pseudo'])->querySelect());
        $user->setUserEmail($_POST['email']);
        $user->setUserPseudo($_POST['pseudo']);
        
        if($edit != 'info') $user->setUserRole($_POST['role']);
        $user->setUserUrl($_POST['pseudo']);
        $user->setUserBdate($_POST['bdate']);
        $user->setUserFirstname($_POST['firstname']);
        $user->setUserName($_POST['lastname']);
        $user->setUserGender($_POST['gender']);

        $maxsize = ini_get("upload_max_filesize");
        $maxsize_octet = 1024*2024 *str_replace("M", "", $maxsize);
        
	    //Création d'un tableau php avec les extensions valides
        $extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
        //chemin en relatif d'upload
        $upload_directory = __DIR__.'/../data/users/'.$_POST['pseudo'];
       
         //Est ce que le fichier avatar existe
        if(isset($_FILES['avatar']))
        {
            if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK)
            {
                if ($_FILES['avatar']['size'] > $maxsize_octet) 
                {
                    $erreur = "Le fichier est trop gros";
                }else
                {            
	                $parse_name = explode(".", $_FILES['avatar']['name']);
	                $extension_upload = strtolower(end($parse_name));

	                if ( in_array($extension_upload,$extensions_valides) )
	                {
	                    if(!file_exists($upload_directory))
	                    {	
	                        mkdir($upload_directory);
	                    }

	                    $nom = $_POST['pseudo'].'.png';
	                    if (move_uploaded_file($_FILES['avatar']['tmp_name'],$upload_directory."/".$nom))
	                    { 	
	                        echo "Transfert réussi";
	                    }
	                    else
	                    {
	                        echo "Transfert echec";
	                    }

	                }else
	                {
	                    echo "Extension incorrecte<br>";
	                }
                }
            }else{

                switch ($_FILES['avatar']['error']) {
                    case UPLOAD_ERR_NO_FILE:
                        echo "fichier manquant<br>";
                        break;
                    case UPLOAD_ERR_INI_SIZE:
                        echo "fichier dépassant la taille maximale autorisée par PHP<br>";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        echo "fichier dépassant la taille maximale autorisée par le formulaire<br>";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        echo "fichier transféré partiellement<br>";
                        break;
                    default:
                        echo "Erreur inconnue ... <br>";
                        break;
                }

            }
        }		

        if(in_array('new', $optionPageController)) {
	        	$hash_psw = password_hash($_POST['password'], PASSWORD_DEFAULT);
	        	$user->setUserPassword($hash_psw);
	        	$user->setUserUrl($_POST['pseudo']);
		        $user->setUserKey(md5(microtime().rand()));
		        $user->save();
        }else {
        	$user->save();
        }
    }
	if(in_array('new', $optionPageController)){
		$optionPageController[count($optionPageController)-1] = $user->getUserId();
		$optionPageController[count($optionPageController)-2] = 'edit';
		$url = implode('/', $optionPageController);
		Sophwork::redirectFromRef($url);
		exit;
	}
	if(in_array('delete', $optionPageController)){
		$user->erase();
		Sophwork::redirect('nimda/users');
		exit;
	}
}elseif(array_key_exists('statusBuilder', $_POST)){
	$KDM = new SophworkDM($app->config);
	$comment = $KDM->create('pp_comment');
		foreach ($_POST['statusBuilder'] as $key => $nodes) {
			$comment->findComId($nodes['id']);
			$comment->setComActive($nodes['status']);
			$comment->save();
		}
	echo '#updated';
	return;
	}


// Redirect to the settings page from referer
Sophwork::redirectFromRef($_POST['pp-referer'].'#updated');
