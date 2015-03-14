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

		$this->addLexerRule('macro', '/{% macro %}(.*){% endmacro %}/s');
		$this->addLexerRule('macro-capture', '/({% macro %})(.*)({% endmacro %})/s');

		$this->addLexerRule('macros', '/{% macros %}(.*){% endmacros %}/s');
		$this->addLexerRule('macros-capture', '/({% macros %})(.*)({% endmacros %})/s');
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
			eval("\$rule = \"$rule\";");
			if(gettype($value) == "array"){
				$this->replaceBlockArray($rule, $value);
			}
			else{
				$value = htmlspecialchars($value); // default escaping
				$this->replaceBlock($rule, $value);
				$this->replaceOne($rule, $value);
			}
		}
		// ob_clean();
		return $this->template;
	}

	public function replaceOne($rule, $value){
		$this->template = preg_replace($rule, $value, $this->template);
	}

	public function replaceBlock($rule, $value){
		// match if any macro block was created
		// if so get the matched result
		// use the simple value parser to replace the tag
		// then replace in the template the macro block with the right data in the template
		preg_match($this->lexer->getRule('macro')[0], $this->template, $match);
		if(isset($match[1])){
			$block = trim($match[1]);
			$block = preg_replace($rule, $value, $block);
			$this->template = preg_replace($this->lexer->getRule('macro-capture')[0], $block, $this->template);
		}
	}

	public function replaceBlockArray($rule, $value){

		preg_match($this->lexer->getRule('macros')[0], $this->template, $match);

		$block = "";
		if(isset($match[1])){
			for($i=0;$i<sizeof($value);$i++){
				$block .= trim($match[1]);
				$value[$i] = htmlspecialchars($value[$i]); // default escaping
				$block = preg_replace($rule, $value[$i], $block);
			}
			$this->template = preg_replace($this->lexer->getRule('macros-capture')[0], $block, $this->template);
		}
	}
}