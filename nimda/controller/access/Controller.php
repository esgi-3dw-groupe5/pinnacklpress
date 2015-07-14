<?php

namespace nimda\controller\access;

use sophwork\core\Sophwork;
use sophwork\app\controller\AppController;

use sophwork\modules\htmlElements\htmlElement;
use sophwork\modules\htmlElements\htmlPage;

use sophwork\modules\htmlElements\htmlForm;
use sophwork\modules\htmlElements\htmlFooter;

use controller\utils\Users;
use controller\utils\Menu;
use controller\posts\Post;

use controller\form\Form;
use controller\form\Validator;

class Controller extends AppController{

    public function __construct(){
        parent::__construct();
    }

    public function __get($param){
        return $this->$param;
    }

    public function __set($param, $value){
        $this->$param = $value;
    }
    
    public function checkPermission($permission){
        $roles = [
            'superadmin' => [
                'superadmin',
                'administrator',
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            "administrator" => [
                'administrator',
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'moderator' => [
                'moderator',
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'editor' => [
                'editor',
                'author',
                'member',
                'visitor',
            ],
            'author' => [
                'author',
                'member',
                'visitor',
            ],

            'member' => [
                'member',
                'visitor'
            ],
            'visitor' => [
                'visitor'
            ],
        ];

        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if(!isset($_SESSION['user']))
            Controller::logout();

        if(!in_array($permission,$roles[$_SESSION['user']['role']])){
            unset($_SERVER['PHP_AUTH_USER']);
            if (!isset($_SERVER['PHP_AUTH_USER'])) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo("<h1>You have not enought rights !</h1><br><a href='".Sophwork::getUrl()."'>Return to Homepage.</a>");
                exit;
            } 
            else {
                $user = $this->KDM->create('pp_user');
                $user->findUserEmail($_SERVER['PHP_AUTH_USER']);
                if(is_null($user->getUserEmail()[0]) && !password_verify($_SERVER['PHP_AUTH_PW'], $user->getUserPassword()[0])){
                    Controller::logout();
                    exit;
                }
            }
            
            $_POST['email'] = $_SERVER['PHP_AUTH_USER'];
            $_POST['password'] = $_SERVER['PHP_AUTH_PW'];
            
            $user = new Users();
            $user->connection($_POST, false);
        }


    }

    public function logout(){
        session_destroy();
        $sophwork = new Sophwork();
        Sophwork::redirect('connection');
        exit;
    }
   
}