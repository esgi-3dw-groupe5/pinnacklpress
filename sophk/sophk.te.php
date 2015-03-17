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
		$this->addLexerRule('variable-search', '/{{(\w+)}}/');
		$this->addLexerRule('variable', '/{{($key)}}/');
		
		$this->addLexerRule('variable-lower-search', '/{{(.*)}\\[L]}/');
		$this->addLexerRule('variable-lower', '/{{($key)}\\[L]}/');
		
		$this->addLexerRule('variable-upper-search', '/{{(.*)}\\[U]}/');
		$this->addLexerRule('variable-upper', '/{{($key)}\\[U]}/');

		$this->addLexerRule('macro-search', '/{% macro %}(.*){% endmacro %}/s');
		$this->addLexerRule('macro-capture', '/({% macro %})(.*)({% endmacro %})/s');

		$this->addLexerRule('macros-search', '/{% macros %}(.*){% endmacros %}/s');
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
			// $this->useRule('variable-lower');
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

	public function parseTemplate($option = null){
		ob_start();
		// $obj = $this->convert($this->data);
		if(preg_match_all($this->lexer->getRule('variable-search')[0], $this->template)){
			$this->useRule('variable');
			$this->observer();
		}
		// ob_clean();
		return $this->template;
	}

	private function convert($data){
		$object = new stdClass();
		foreach ($data as $key => $value)
		{
			if(gettype($value)=='array')
				$value = $this->convert($value);
			$object->$key = $value;
		}

		return $object;
	}

	private function observer(){
		foreach ($this->data as $key => $value) {
			if(gettype($value) == "array"){
				$this->useRule('variable');
				$rule = $this->rule;
				
				$this->replaceBlockArray($rule, $key, $value);
				$this->replaceBlock($rule, $key, $value);
			}
			else{
				$this->useRule('variable');
				$rule = $this->rule;

				$value = $this->optionalModifier($value);
				
				$this->replaceBlock($rule, $key, $value);
				$this->replaceOne($rule, $key, $value);
			}
		}
	}
	public function optionalModifier($value, $option = null){
		if(gettype($value)!='array'){
			if($option == 'lower')
				return strtolower($value);
			if($option == 'upper')
				return strtoupper ($value);
			return htmlspecialchars($value);
		}
		else{
			foreach ($value as $key => $val) {
				$val = $this->optionalModifier($val, $option);

				if($option == 'lower')
					$value[$key] = strtolower($val);
				if($option == 'upper')
					$value[$key] = strtoupper ($val);
				$value[$key] = htmlspecialchars($val);
			}
		}
		return $value[0];
	}

	public function replaceOne($rule, $key, $value, $block = null){
		
		eval("\$rule = \"$rule\";");
		if($block !== null){
			if(gettype($value) != 'array')
				return preg_replace($rule, $value, $block);
		}
		$this->template = preg_replace($rule, $value, $this->template);
	}

	public function replaceBlock($rule, $key, $value){
		// match if any macro block was created
		// if so get the matched result
		// use the simple value parser to replace the tag
		// then replace in the template the macro block with the right data in the template
		preg_match($this->lexer->getRule('macro-search')[0], $this->template, $match);
		if(isset($match[1])){
			preg_match_all("/{{(\\w+)}}/", trim($match[1]), $matches);
			if(isset($matches[1][0]) && $matches[1][0] != $key)
				return;

			$block = trim($match[1]);

			$this->useRule('variable');
			$rule = $this->rule;
			$value = $this->optionalModifier($value,'');
			$block = $this->replaceOne($rule, $key, $value, $block);

			$this->useRule('variable-lower');
			$rule = $this->rule;
			$value = $this->optionalModifier($value,'lower');
			$block = $this->replaceOne($rule, $key, $value, $block);

			$this->useRule('variable-upper');
			$rule = $this->rule;
			$value = $this->optionalModifier($value,'upper');
			$block = $this->replaceOne($rule, $key, $value, $block);

			$this->template = preg_replace($this->lexer->getRule('macro-capture')[0], $block, $this->template);
		}
	}

	public function replaceBlockArray($rule, $key, $value){
		preg_match($this->lexer->getRule('macros-search')[0], $this->template, $match);

		$block = "";
		if(isset($match[1])){
			preg_match_all("/{{(\\w+)}}/", trim($match[1]), $matches);
			if(isset($matches[1][0]) && $matches[1][0] != $key)
				return;
			
			for($i=0;$i<sizeof($value);$i++){
				$block .= trim($match[1]);

				$this->useRule('variable');
				$rule = $this->rule;
				$value[$i] = $this->optionalModifier($value[$i],'');
				$block = $this->replaceOne($rule, $key, $value[$i], $block);

				$this->useRule('variable-lower');
				$rule = $this->rule;
				$value[$i] = $this->optionalModifier($value[$i],'lower');
				$block = $this->replaceOne($rule, $key, $value[$i], $block);
				
				$this->useRule('variable-upper');
				$rule = $this->rule;
				$value[$i] = $this->optionalModifier($value[$i],'upper');
				$block = $this->replaceOne($rule, $key, $value[$i], $block);

			}
			$this->template = preg_replace($this->lexer->getRule('macros-capture')[0], $block, $this->template);
		}
	}
}