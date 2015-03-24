<?php

class SophworkDM{
	public $link;
	public $config;

	public function __construct($config){
		$this->getConfig($config);
		$this->link = $this->dbConnect();
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function getConfig($config){
		$this->config = $config;
	}

	public function dbConnect(){
		if(sizeof($this->config) >= 4){
			$db_host 		= $this->config['db_host'];
			$db_name 		= $this->config['db_name'];
			$db_login 		= $this->config['db_login'];
			$db_password 	= $this->config['db_password'];
			try{
				$link = new PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_login, $db_password,
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
				);
			}
			catch(Exeption $e){
				die('ERREUR :'.$e->getMessage);
			}
			return $link;
		}
		return null;
	}

	public function create($entityName){
		$entity = new SophKDMEntities();

		$req1 = $this->link->query("show tables where Tables_in_sophk = '".$entityName."'");
		// $req1 = $this->link->query("SHOW TABLES");
		while($table = $req1->fetch()){
			$req2 = $this->link->query("SHOW COLUMNS FROM ".$table['Tables_in_sophk']);
			while($columns = $req2->fetch()){
				$entity->$columns['Field'] = null;
				// $KDM[$table['Tables_in_sophk']][] = $columns['Field'];
			}
		}
		return $entity;
	}
}

class SophworkDMEntities extends SophworkDM{
	protected $data;

	public function __construct(){
		$this->data = [];
	}

	public function __set($param, $value) {
		$this->data[$param] = $value;
		// $this->$param = $value;
	}
	
	public function __get($param) {
		if (array_key_exists($param, $this->data)) {
			return $this->data[$param];
		}

		$trace = debug_backtrace();
		trigger_error(
		'Undefined property via __get(): ' . $param .
		' in ' . $trace[0]['file'] .
		' on line ' . $trace[0]['line'],
		E_USER_NOTICE);
		return null;
	}
}