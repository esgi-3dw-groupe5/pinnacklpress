<?php

namespace controller\form;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Rule{

	protected $msg;

	public function __construct(){
		$this->msg = [];
	}

	public function __get($param){
		return $this->$param;
	}

	public function isMail($value){
		if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
				$this->msg[] = "Vous devez saisir une adresse email valide.";
				return false;
			}
		return true;
	}

	public function isPassword($value,$value2){
		if (!preg_match("/.*^(?=.{8,20})(?=.*[a-z])(?=.*[0-9]).*$/",$value) 
			|| strlen($value)<8
			|| strlen($value)>20){
				if($value != $value2){
					$this->msg[] = "Les mots de passe sont différents";
				}
				$this->msg[] = "Le mot de passe ne respecte pas les caractères requis";
				return false;
			}
		if($value != $value2){
					$this->msg[] = "Les mots de passe sont différents";
					return false;
		}	
		return true;
	}
// to be tested
	public function isDate($value){
		$check=0;
		if(preg_match("/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](\d\d\d\d)$/", $value, $dateArr)==1){$check=1;}
		else if(preg_match("/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](\d\d\d\d)$/", $value, $dateArr)==1){$check=1;}
		else if(preg_match("/^(\d\d\d\d)[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])$/", $value, $dateArr)==1){$check=1;}
		if( $check==0 ){
			$this->msg[] = "Ceci n'est pas une date";
			return false;
		}elseif( $check==1 && $dateArr[0] == 10){
			if( !checkdate($dateArr[2], $dateArr[1], $dateArr[3]) ){
				$this->msg[] = "Cette date n'existe pas";
				return false;
			}	
		}
        $date = date_diff(date_create($value), date_create('today'))->y;
        if($check==1 && $date<7){
            $this->msg[] = "Vous n'avez pas encore l'âge de raison";
            return false;
        }
		return true;
	}
}