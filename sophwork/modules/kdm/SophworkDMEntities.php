<?php
/*
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Sophpkwork module : ORM Data mapper
 *	Data mapper entities class
 */

namespace sophwork\modules\kdm;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;

class SophworkDMEntities extends SophworkDM{
	protected $table;
	protected $primaryKey;
	public $link;
	protected $data;

	public function __construct(){
		$this->data = [];
	}

	public function __set($param, $value) {
		$this->data[$param] = $value;
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

	public function setLink($link){
		$this->link = $link;
	}

	public function getLink(){
		return $this->link;
	}
	
	public function setPk($primaryKey){
		$this->primaryKey = $primaryKey;
	}

	public function getPk(){
		return $this->primaryKey;
	}
	
	public function setTable($table){
		$this->table = $table;
	}

	public function getTable(){
		return $this->table;
	}

	public function save(){
		if($this->user_id == null)
			$this->insert($this->table, $this->data);
		else{
			$pk = $this->getPk(); $pkValue = $this->$pk;
			$this->update($this->table, $this->data, "$pk = $pkValue");
		}
	}
}