<?php

namespace Core;

use sophwork\core\Sophwork;

class Core {

	private $action;
	private $displayErr;

	function __construct(){
		$this->action = null;
		$this->displayErr = null;
	}

	public function setAction($POST){

		if( array_key_exists('db_submit',$_POST) ) {

    		$this->action = 'db_submit';

		}
		else{
			// get all form
			$formList = getAllForm();
			while($data = $formList -> fetch()){
				if( array_key_exists($data['form_name'], $POST)){

					$this->action = $data['form_id'];

				}
			}
		}

		return $this->action;
	}

	public function sendAction($action,$POST){

		if ( $action == 'db_submit' ){

			$this->displayErr = Sophwork::setConfig($POST);
			Sophwork::redirect();

		}
		else{
			$fields = getFields($action);
			$this->displayErr = Temp::control($fields,$POST);
		}
		
		return $this->displayErr;
	}
}

?>