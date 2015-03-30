<?php
/*
 *	This file is for testing purpose
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Namespace inclusion test
 */

require 'Sophwork/autoloader.php';

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

// use modules
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophKDMEntities;

$sophwork 	= new Sophwork();
$app 		= new SophworkApp();

$SophworkDM = new SophworkDM($app->config);

$field = $SophworkDM->create('pp_field');

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';
echo "<b><u>Use test of SophworkDM create</u></b>\r\n";
	var_dump($field);
echo'</pre>';

$field->setFieldType('text');
echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';
echo "<b><u>Use test of SophworkDM set</u></b>\r\n";
	var_dump($field);
echo'</pre>';

$field->save();
echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';
echo "<b><u>Use test of SophworkDM save insert</u></b>\r\n";
	var_dump($field);
echo'</pre>';

$field->setFieldType('email');
$field->save();

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';
echo "<b><u>Use test of SophworkDM save update</u></b>\r\n";
	var_dump($field);
echo'</pre>';