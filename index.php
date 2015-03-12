<?php
require_once('sophk/core.sophk.php');
require_once('sophk/sophk.te.php');
// require('app.formValidate.php');

/*
 *	Create a new applicaion with the SophApp class
 *	It will create 3 new class :
 *		- appContrller class
 *		- appModel class
 *		- appView class
 */
$Sophk = new Sophk();
$app = new SophKApp();
echo $app->KTE->parseTemplate();

// --
// $rule = new NotEmptyValidationRule('db_host');SophK::debug($rule);
// $validator = new FormValidator();
// $validator->addRule($rule);SophK::debug($validator);

// $aForm = $__POST['myForm'];
// $validationResult = $validator->validate($aForm);

// if ($validationResult->validationPassed()) {
// 	$errorsFound = $validationResult->errorsFound();
// 	// do something with the $errorMessage
// 	$errorMessage = array_join('<br/>', $errorsFound);        
// }
// die();
// --

// $controller = $app->appController;
	  // $page = $controller->page;

/*
 *	Get the data from the database from appModel class
 */
// $data = $controller->getDataFromModel();

// foreach ($data as $param => $value) {
// 	$app->setViewData($param, $value);
// }
// --

/*
 *	Set data from the application without using the appModel class
 */
// $app->setViewData('title', 'My First SophK App');
// $app->setViewData('h1', 'Hello World');
// --


// $app->callView('index');

/*
 *	Uncomment to tryout
 */
// $app->setViewData('h1', 'This is an H1 title');
// $app->setViewData('footer', 'This is the footer');
// $app->callView("index");

// $test = [
// 	'plop1' => 'plop1',
// 	'plop2' => 'plop2',
// 	'plop3' => 'plop3',
// ];

// foreach ($test as $key => $value) {
// 	$$test[$key] = $value;
// }

// echo $plop1;
// echo $plop2;
// echo $plop3;