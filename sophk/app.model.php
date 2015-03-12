<?php

class AppModel extends SophKApp{
	protected $data;
	public function __construct(){
		$this->data = [
			"name" => "index",
			"title" => "My First SophK App",
			"h1" => "Hello World",
		];
	}
	public function __get($data){
		return $this->data;
	}

	public function __set($param, $value){

	}

	public function initDatabase(){
		try{
			$link = new PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_login,$db_password,
			array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			));
		}
		catch(Exception $e){
			die("Erreur : ".$e->getMessage());
		}
		return $link;
	}

}