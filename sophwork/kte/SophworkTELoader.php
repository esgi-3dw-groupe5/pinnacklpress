<?php

namespace sophwork\kte;

class SophworkTELoader{
	protected $template;

	public function __construct(){ // FIXME : add the loading of multiple template in 1 loader (array)

	}

	public function __get($param){
		return $template;
	}

	public function loadFromArray($template){
		// not used yet
	}

	public function loadFromFile($template){
		if(file_exists($template))
			return $this->template = file_get_contents($template);
	}
}