<?php

namespace controller\utils;

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;
use sophwork\app\controller\AppController;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use PasswordLib\PasswordLib;
    
class Users extends \sophwork\app\controller\AppController {
    
    protected $user;
    
    public function __construct(){
        parent::__construct();
        $this->user = $this->KDM->create('pp_user');
        return $this->user;
    }
    
    public function connection($POST){
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['name']);
        if($this->user->getUserId()[0]!=null)
        {
            $password = $user->getUserPassword()[0];
            
            $lib = new PasswordLib();
            if ($lib->verifyPasswordHash($password, $hash))
            {
                session_start();
                $_SESSION['email']=$user->getUserEmail()[0];
                $_SESSION['pseudo']=$user->getUserPseudo()[0];
                $_SESSION['role']=$user->getUserRole()[0];
                $_SESSION['connected']=true;
                
            }
            else
            {
                $_SESSION['error'][]="Le mot de passe est incorrect";
            }
        }
        else
        {
            $_SESSION['error'][]="Ce pseudonyme n'existe pas";
        }
    }
    
    public function inscription($POST){
        var_dump($POST);
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['email']);
        if($this->user->getUserId()[0]==null){ //FIXME : replace default data
            
            $lib = new PasswordLib();
            $passcrypt = $lib->createPasswordHash($POST['password']);
            
            $userkey = $lib->getRandomToken(32);
            
            $this->user->setUserEmail($POST['email']);
            $this->user->setUserPassword($passcrypt);
            $this->user->setUserPseudo($POST['pseudo']);
            $this->user->setUserGender('2');
            $this->user->setUserFirstname($POST['firstname']);
            $this->user->setUserName($POST['lastname']);
            $this->user->setUserBdate($POST['date']);
            $this->user->setUserRole('Viewer');
            $this->user->setUserKey($userkey);
            $this->user->setUserActive('0');
            $this->user->setUserUrl($POST['pseudo']);

            $this->user->save();
            
            $_SESSION['error'][]="Vous êtes inscrits";
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($_SESSION['pp-referer']);
            exit;
        }
        else{
            $_SESSION['error'][]="L'utilisateur existe déjà";
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($_SESSION['pp-referer']);
            exit;
        }
        var_dump($this->user);
        
    }
    
    public function initUser(){
        $_SESSION['user'] = [];
        $_SESSION['user']['pseudo']     = null;
        $_SESSION['user']['email']      = null;
        $_SESSION['user']['role']       = 'visitor';
        $_SESSION['user']['connected']  = false;
    }
    
    function checkPermission($permission){
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
        
        if(!in_array($permission,$roles[$_SESSION['user']['role']])){
            header("HTTP/1.0 404 Not Found");
            echo "ERREUR DROITS";
            die();
            //FIXME : ADD 404.tpl
        }
        
            
    }
    
    
    
    
    
}

