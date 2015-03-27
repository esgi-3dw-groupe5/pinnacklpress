<?php
/*
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
		$this->setConfig($config);
		$this->link = $this->dbConnect();
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function setConfig($config){
		$this->config = $config;
	}
	
	public function getConfig(){
		return $this->config;
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
			$entity->setTable($entityName);
		$req1 = $this->link->query("show tables where Tables_in_sophk = '".$entityName."'");
		while($table = $req1->fetch()){
			$req2 = $this->link->query("SHOW COLUMNS FROM ".$table['Tables_in_sophk']);
			while($columns = $req2->fetch()){
				$entity->$columns['Field'] = null;
			}
		}
		$req3 = $this->link->query("SHOW KEYS FROM ".$entityName." WHERE Key_name = 'PRIMARY'");
			$primaryKey = $req3->fetch();
				$entity->setPk($primaryKey['Column_name']);
		$entity->setLink($this->link);
		return $entity;
	}

    public function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null){
        $query = 'SELECT ' . $fields . ' FROM ' . $table
               . (($where) ? ' WHERE ' . $where : '')
               . (($limit) ? ' LIMIT ' . $limit : '')
               . (($offset && $limit) ? ' OFFSET ' . $offset : '')
               . (($order) ? ' ORDER BY ' . $order : '');
        $req = $this->query($query);
        return $req->rowCount();
    }

    public function insert($table, array $data){
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map('preg_quote', array_values($data)));
        $query = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
        $req = $this->link->query($query);
        return $this->link->lastInsertId();
    }

    public function update($table, array $data, $where = ''){
        $set = array();
        foreach ($data as $field => $value) {
            $set[] = $field . '=' . $this->quoteValue($value);
        }
        $set = implode(',', $set);
        $query = 'UPDATE ' . $table . ' SET ' . $set
               . (($where) ? ' WHERE ' . $where : '');
        $req = $this->link->query($query);
        return $req->rowCount();
    }

    public function delete($table, $where = ''){
        $query = 'DELETE FROM ' . $table
               . (($where) ? ' WHERE ' . $where : '');
        $req = $this->link->query($query);
        return $req->rowCount();
    }
}