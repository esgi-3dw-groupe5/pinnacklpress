<?php
// echo "Split Object PHP Framework - SOPHK";
// Autoloader
function autoloader($file){
	if(file_exists('sophk/'.$file)){
 		require_once('sophk/'.$file);
	}
	else{
		throw new Exception(' not found');
	}
}

try{
	autoloader('sophk.app.php');
	autoloader('app.view.php');
	autoloader('app.controller.php');
	autoloader('app.model.php');
}
catch(Exception $e) {
	die("Fatal error : ".$e->getMessage());
}

class Sophk {
	private $name 		= "SophK";
	private $description 	= "Split Object PHP Framework - SophK";
	private $version 		= "0.1.0";

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
		if( !file_exists('config.local.php') ){
			return false;
		}
		require_once(dirname(__FILE__).'/config.local.php');
		return true;
	}

	public function setConfig($POST){
		$handle = fopen('config.local.php', "w+");
		$text = "<?php\n$config = array(\n
					'db_host' => '',\n
					'db_name' => '',\n
					'db_login' => '',\n
					'db_password' => '',\n
					);
		";
		fwrite($handle, $text);
		fclose($handle);
		require_once(dirname(__FILE__).'/../config.local.php');
	}
}