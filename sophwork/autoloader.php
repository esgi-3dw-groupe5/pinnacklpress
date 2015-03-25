<?php

function __autoload($c){
// Autoloader
	echo "<pre>";
	echo dirname(__FILE__)."/..".__NAMESPACE__ . "/". $c . ".php";
	echo "</pre>";
	try{
		if(file_exists(dirname(__FILE__)."/..".__NAMESPACE__ . "/". $c . ".php"))
			require_once "/..".__NAMESPACE__ . "/". $c . ".php";
		else
			throw new Exception('<b>' . $c . '</b> not found');
	}
	catch(Exception $e) {
		die("Autoload fatal error : ".$e->getMessage());
	} 
}