<?php

class Core {

	private $action;
	private $displayErr;

	function __construct(){
		$action = null;
		$displayErr = null;
	}

	public function setAction($_POST){

		if( isset($_POST['db_submit']) 
			&& !empty($_POST['db_submit']) ) {

    	$action = $_POST['db_submit'];

		}

		return $action;
	}

	public function 
}

?>