<?php
/*
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
	
	public static function redirect($parameters = null){
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

		// correspond to this specific case
		$URI = preg_split("/\//",$_SERVER['REQUEST_URI']);
		$c = count($URI);
		if($c < 3)
			$localUrl = $protocol . "://" . $_SERVER['SERVER_NAME'] ."/" .$parameters;
		else
			$localUrl = $protocol . "://" . $_SERVER['SERVER_NAME'] ."/". $URI[1] ."/" .$parameters;
		header("Location: ".$localUrl);
	}

	public static function getUrl($parameters = null){
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

		// correspond to this specific case
		$URI = preg_split("/\//",$_SERVER['REQUEST_URI']);
		$c = count($URI);
		if($c < 3)
			return $protocol . "://" . $_SERVER['SERVER_NAME'] ."/" .$parameters;
		else
			return $protocol . "://" . $_SERVER['SERVER_NAME'] ."/". $URI[1] ."/" .$parameters;
	}
}

