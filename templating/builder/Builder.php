<?php

namespace sophwork\modules\builder;

class builder extends htmlElement{
	protected $data;
	
	public function __construct($data){
		$this->data = $data;
	}

	
}