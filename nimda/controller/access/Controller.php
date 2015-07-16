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

        $this->grantAsAdmin($permission, $roles);
    }

    public function grantAsAdmin($permission, $roles){
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if(!isset($_SESSION['user']))
            Controller::logout();
        if(!in_array($permission, $roles[$_SESSION['user']['role']])){
            if($this->page != 'login')
                Sophwork::redirect('nimda/login');
            $includeUrl = Sophwork::getUrl('nimda/');
            $siteUrl = Sophwork::getUrl();
            $login = null;
            $error = false;
            if(isset($_POST['email'])){
                $user = $this->KDM->create('pp_user');
                $user->findUserEmail($_POST['email']);
                if(is_null($user->getUserEmail()[0])){
                    $error = true;
                    $login = $_POST['email'];
                }
                elseif(!password_verify($_POST['password'], $user->getUserPassword()[0])){
                    $error = true;
                    $login = $_POST['email'];
                }
                else{
                    $user = new Users();
                    $user->connection($_POST, false);
                    if(!in_array($permission, $roles[$_SESSION['user']['role']])){
                        $error = true;
                        $login = $_POST['email'];
                    }
                    else
                        Sophwork::redirect('nimda');
                }
            }
            require_once(__DIR__ . '/../../template/nimda-connection.tpl'); //fixme use form class to verify the form
            exit;
        }
       else{
            if($this->page == 'login')
                Sophwork::redirect('nimda');
        }
    }

    public function logout(){
        session_destroy();
        $sophwork = new Sophwork();
        Sophwork::redirect('connection');
        exit;
    }
   
}