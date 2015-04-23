<?php
/**
 *	This file is for testing purpose
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Namespace inclusion test
 */

require 'Sophwork/autoloader.php';

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;
use sophwork\app\view\AppView;
use sophwork\app\model\AppModel;

// use modules
	// KTE
use sophwork\modules\kte\SophworkTELoader;
use sophwork\modules\kte\SophworkTELexer;
use sophwork\modules\kte\SophworkTEParser;
	// KDM
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophKDMEntities;

$sophwork 	= new Sophwork();
$app 		= new SophworkApp();

$appController 	= new AppController();
$appView 		= new AppView();
$appModel 		= new AppModel(); 
$SophworkDM = new SophworkDM($app->config);

$sophworkTELoader	= new SophworkTELoader('');
$sophworkTELexer	= new SophworkTELexer();
$sophworkTEParser	= new SophworkTEParser('',[]);

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';
echo "<b><u>Inclusion test of Sophwork</u></b>\r\n";
	var_dump($sophwork);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of SophworkApp</u></b>\r\n";
	var_dump($app);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of AppController</u></b>\r\n";
	var_dump($appController);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of AppView</u></b>\r\n";
	var_dump($appView);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of AppModel</u></b>\r\n";
	var_dump($appModel);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of SophworkDM</u></b>\r\n";
	var_dump($SophworkDM);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of SophworkTELoader</u></b>\r\n";
	var_dump($sophworkTELoader);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of SophworkTELexer</u></b>\r\n";
	var_dump($sophworkTELexer);
echo'</pre>';

echo'<pre style="padding:10px;background:#5f9ea0; border-radius:5px;">';	
echo "<b><u>Inclusion test of SophworkTEParser</u></b>\r\n";
	var_dump($sophworkTEParser);
echo'</pre>';

