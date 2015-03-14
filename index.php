<?php
require_once('sophk/core.sophk.php');
require_once('sophk/sophk.te.php');
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

$controller = $app->appController;
	  $page = $controller->page;
	  
// use KTE to render the template
echo $app->KTE->parseTemplate();