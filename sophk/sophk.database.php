<?php


require_once(dirname(__FILE__).'/core.sophk.php');

//$Sophk = new Sophk;

//$Sophk->getConfig();
/*function db_create() {
    $host="localhost"; 

    $root="root"; 
    $root_password=""; 

    $user='newuser';
    $pass='newpass';
    $db="newdb"; 


    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);

        $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
            or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
}*/


print_r(dirname(__FILE__));
    




?>