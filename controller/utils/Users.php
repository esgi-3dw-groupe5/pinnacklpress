<?php

namespace controller\utils;

use sophwork\core\Sophwork;
    
class Users extends \sophwork\app\controller\AppController {
    
    protected $user;
    
    public function __construct(){
        parent::__construct();
        $this->user = $this->KDM->create('pp_user');
        return $this->user;
    }
    
    public function connection($POST){
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['email']);
        if($this->user->getUserId()[0]!=null)
        {
            
            
            if(password_verify($POST['password'], $this->user->getUserPassword()[0]))
            {
                $_SESSION['user']['email']=$this->user->getUserEmail()[0];
                $_SESSION['user']['pseudo']=$this->user->getUserPseudo()[0];
                $_SESSION['user']['role']=$this->user->getUserRole()[0];
                $_SESSION['user']['connected']=true;
                
                $_SESSION['form']['error'][]="Vous êtes connecté";
                $sophwork = new Sophwork();
                Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
                exit;
                
            }
            else
            {
                $_SESSION['form']['error'][]="Le mot de passe est incorrect";
                $sophwork = new Sophwork();
                Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
                exit;
            }
        }
        else
        {
            $_SESSION['form']['error'][]="Ce pseudonyme n'existe pas";
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
    }
    
    public function inscription($POST){
        var_dump($POST);
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['email']);
        if($this->user->getUserId()[0]==null){ //FIXME : replace default data
            
            
            
            $hash_psw = password_hash($POST['password'], PASSWORD_DEFAULT);
            
            $userkey = $lib->getRandomToken(32);
            
            $this->user->setUserEmail($POST['email']);
            $this->user->setUserPassword($hash_psw);
            $this->user->setUserPseudo($POST['pseudo']);
            $this->user->setUserGender('2');
            $this->user->setUserFirstname($POST['firstname']);
            $this->user->setUserName($POST['lastname']);
            $this->user->setUserBdate($POST['date']);
            $this->user->setUserRole('visitor');
            $this->user->setUserKey($userkey);
            $this->user->setUserActive('0');
            $this->user->setUserUrl($POST['pseudo']);

            $this->user->save();
            
            $_SESSION['form']['error'][]="Vous êtes inscrits";
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
        else{
            $_SESSION['form']['error'][]="L'utilisateur existe déjà";
            $sophwork = new Sophwork();
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
        var_dump($this->user);
        
    }
    
    public function initUser(){
        $_SESSION['user']['pseudo']     = null;
        $_SESSION['user']['email']      = null;
        $_SESSION['user']['role']       = 'visitor';
        $_SESSION['user']['connected']  = false;
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
        
        if(!in_array($permission,$roles[$_SESSION['user']['role']])){
            header("HTTP/1.0 404 Not Found");
            echo "ERREUR DROITS";
            die();
            //FIXME : ADD 404.tpl
        }
        
            
    }
    
    public function logout(){
        session_destroy();
        $sophwork = new Sophwork();
        Sophwork::redirectFromRef('index');
        exit;
    }
    
    
    
    
    
}

