<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Split Object PHP Framework - Sophwork
 */

namespace sophwork\core;

class Sophwork {
	private $name 		= "sophwork";
	private $description 	= "Split Object PHP Framework - Sophwork";
	private $version 		= "0.2.0";

	public function __construct(){

	}

	public static function debug($value){
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}

	public static function getParam($param_name, $init_value) {
		$param_value = $init_value;
		if (isset($_GET[$param_name])) {
			$param_value = htmlspecialchars($_GET[$param_name]);
		}    
		return $param_value;
	}
	public function setHtaccess($root){
		$handle = fopen(dirname(__FILE__).'/../.htaccess', "w+");
		$text = "Options -MultiViews\nRewriteEngine On\nRewriteBase /".$root."/\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\n#	article categorie access\nRewriteRule    ^([a-z0-9_-]+)/?([a-z0-9_-]*)/?$    	index.php?p=$1&a=$2	[NC,L]\n";
		fwrite($handle, $text);
		fclose($handle);
	}

	public function getConfig(){
		$config = null;
		if( !file_exists('config.local.php') ){
			return false;
		}
		require_once(dirname(dirname(__FILE__)).'/../config.local.php');
		return $config;
	}

	public static function setConfig($POST){
		$handle = fopen('config.local.php', "w+");
		$text = "<?php\n\$config = array(\n
		'db_host' => '".$POST['db_host']."',\n
		'db_name' => '".$POST['db_name']."',\n
		'db_login' => '".$POST['db_login']."',\n
		'db_password' => '".$POST['db_password']."',\n
		);
		 ";
		fwrite($handle, $text);
		fclose($handle);
		require_once(dirname(__FILE__).'/../config.local.php');
	}
}

