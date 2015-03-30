<?php
/*
 *	This file is a part of the sophwork project
 *	@Tested version : Sophwork.0.2.1
 *	@author : Syu93
 *	--
 *	Main model class
 */

namespace sophwork\app\model;

use sophwork\app\app\SophworkApp;

class AppModel extends SophworkApp{

	protected $data;

	public function __construct(){
		$this->data = [
			"name" => "index",
			"title" => "My First Sophwork App",
			"h1" => "Hello World",
		];
	}
	public function __get($data){
		return $this->data;
	}

	public function __set($param, $value){

	}

	public function connectDatabase(){
		try{
			$link = new \PDO('mysql:host='.$db_host.';dbname='.$db_name,$db_login,$db_password,
			array(
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			));
		}
		catch(Exception $e){
			die("Erreur : ".$e->getMessage());
		}
		return $link;
	}
    
    public function createDatabase($host, $root, $root_pswd, $user, $user_pswd, $new_db)
    {
        try {
            $db = new \PDO("mysql:host=$host", $root, $root_pswd);

            $db->exec("CREATE DATABASE `$new_db`;
                CREATE USER '$user'@'$host' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'$host';
                FLUSH PRIVILEGES;") 
                or die(print_r($db->errorInfo(), true));

        } catch (\PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }

    /*  ^              ^  */
    /* /!\ DEPRECATED /!\ */
    /* ___            ___ */
    //FIXME : Use simple CRUD method instead
    function createUser($link, $gender, $name, $firstname, $email, $password, $pseudo, $date, $cle){
        try{
            $req = $link -> prepare("INSERT INTO pp_users 
			(gender, firstname, name, pseudo, email, password, birth_date,cle)
			VALUES( :gender,
					:firstname,
					:name,
					:pseudo,
					:email,
					:password,
					:birth_date,
                    :cle) ");
            $success = $req->execute(array(
                ':gender' => $gender,
                ':firstname' => $firstname,
                ':name' => $name,
                ':pseudo' => $pseudo,
                ':email' => $email,
                ':password' => $password,
                ':birth_date' => $date,
                ':cle' => $cle
            ));
            return $success;
        }
        catch( PDOException $e ){

            debug($e);
            die();
        }


    }

}