<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Namespace autoloader
 */

function __autoload($c){
// Autoloader
	// echo "<pre>";
	// echo dirname(__FILE__)."/..".__NAMESPACE__ . "/". $c . ".php";
	// echo "</pre>";
	try{
		if(file_exists(dirname(__FILE__) . "/.." . __NAMESPACE__ . "/". $c . ".php"))
			require_once dirname(__FILE__) . "/.." . __NAMESPACE__ . "/". $c . ".php";
		else
			throw new Exception('<b>' . $c . '</b> not found');
	}
	catch(Exception $e) {
		die("Autoload fatal error : ".$e->getMessage());
	} 
}