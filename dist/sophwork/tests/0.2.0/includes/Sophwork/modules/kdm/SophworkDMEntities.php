<?php
/**
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.0
 *	@author : Syu93
 *	--
 *	Sophpkwork module : ORM Data mapper
 *	Data mapper entities class
 */

namespace sophwork\modules\kdm;

use sophwork\modules\kdm\SophworkDM;

class SophworkDMEntities extends SophworkDM{
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
}