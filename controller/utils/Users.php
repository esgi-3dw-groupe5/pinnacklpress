<?php

namespace controller\utils;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

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
            if($this->user->getUserPassword()[0]==$POST['password'])
            {
                session_start();
                $_SESSION['email']=$user->getUserEmail()[0];
                $_SESSION['pseudo']=$user->getUserPseudo()[0];
                $_SESSION['role']=$user->getUserRole()[0];
                $_SESSION['connected']=true;
                
            }
        }
        var_dump($this->user);
    }
    
    public function inscription($POST){
        var_dump($POST);
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['name']);
        if($this->user->getUserId()[0]==null){ //FIXME : replace default data
            $this->user->setUserEmail($POST['name']);
            $this->user->setUserPassword($POST['password']);
            $this->user->setUserPseudo('plopPseudo');
            $this->user->setUserGender('1');
            $this->user->setUserFirstname('Lorem');
            $this->user->setUserName('Ipsum');
            $this->user->setUserBdate('1990-10-20');
            $this->user->setUserRole('Viewer');
            $this->user->setUserKey('azerty123');
            $this->user->setUserActive('0');
            $this->user->setUserUrl('Lorem-Ipsum');

            $this->user->save();
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

