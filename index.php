<?php
require_once('sophk/core.sophk.php');
require_once('sophk/sophk.te.php');
require_once('sophk/sophk.dm.php');
require_once('controller/controller.core.php');
require('controller/controller.form.php');
// require('app.formValidate.php');

/*
 *	Create a new applicaion with the SophApp class
 *	It will create 3 new class :
 *		- appContrller class
 *		- appModel class
 *		- appView class or use the template engine sophKTE
 */
$Sophk = new Sophk();
$app = new SophKApp();
$KDM = new SophKDM($app->config);

// $controller = $app->appController = new AppController($KDM) ;
// $user = $KDM->create('pp_user');
	// Sophk::debug($user);
$controller = $app->appController;
	  echo $page = $controller->page;
	  
// use KTE to render the template
echo $app->KTE->parseTemplate();