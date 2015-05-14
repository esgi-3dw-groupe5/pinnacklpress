<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Sophpkwork module : ORM Data mapper
 *	Data mapper class
 */

namespace sophwork\modules\kdm;

use sophwork\modules\kdm\SophworkDMEntities;

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
				$link = new \PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_login, $db_password,
				array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
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
		$entity = new SophworkDMEntities();

		$req1 = $this->link->query("show tables where Tables_in_sophk = '".$entityName."'");
		while($table = $req1->fetch()){
			$req2 = $this->link->query("SHOW COLUMNS FROM ".$table['Tables_in_sophk']);
			while($columns = $req2->fetch()){
				$entity->$columns['Field'] = null;
			}
		}
		return $entity;
	}
}