<?php

class SophKTELoader{
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

class SophKTELexer{
	public $token;
	public $rules;
	public $environment;


	public function __construct(){
		$this->rules = [];
		$this->addLexerRule('variable', '/{{({$key})}}/');
		$this->addLexerRule('block', '/({% macro %})(.*)({% endmacro %})/s');
	}
	public function __get($param){
		return $this->$param;
	}

	public function getRule($rulename){
		return $this->rules[$rulename];
	}

	public function addEnvironment($environment){
		$this->environment = $environment;
	}

	// NOTE !: If you pute variable in your rule beware that they no be interpreted use single quote '' and encapsule with {}
	public function addLexerRule($rulename, $rule){
		$this->rules[$rulename] = [];
		$this->rules[$rulename][] = $rule; 
	}
}

class SophKTEParser{
	protected $template;
	protected $lexer;
	protected $data;

	private $rule;

	public function __construct($template, $data=null){
			$this->addData($data);
			$this->template = $template;
			$this->lexer = new SophKTELexer();
			$this->useRule('variable');
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function addData($data){
		$this->data = $data;
	}

	public function useRule($rulename){
		$this->rule = $this->lexer->getRule($rulename)[0];
	}

	public function parseTemplate(){
		ob_start();
		foreach ($this->data as $key => $value) {
			$rule = $this->rule;
			$value = htmlspecialchars($value); // default escaping
			eval("\$rule = \"$rule\";");
			$this->template = preg_replace($rule, $value, $this->template);
		}
		ob_clean();
		return $this->template;
	}
}