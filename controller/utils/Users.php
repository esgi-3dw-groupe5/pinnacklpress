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
        if($this->user->getUserId()[0]==null)
        {
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
        $_SESSION['user']=[];
        $_SESSION['user']['pseudo']=null;
        $_SESSION['user']['email']=null;
        $_SESSION['user']['role']='author';
        $_SESSION['user']['connected']=false;
    }
    
    function checkPermission($permission){
        $roles = array(
            "superadmin" => array(
                0 => "superadmin",
                1 => "administrator",
                2 => "moderator",
                3 => "editor",
                4 => "author",
                5 => "member",
                6 => "visitor" ),

            "administrator"  => array(
                0 => "administrator",
                1 => "moderator",
                2 => "editor",
                3 => "author",
                4 => "member",
                5 => "visitor" ),

            "moderator"  => array(
                0 => "moderator",
                1 => "editor",
                2 => "author",
                3 => "member",
                4 => "visitor" ),

            "editor"  => array(
                0 => "editor",
                1 => "author",
                2 => "member",
                3 => "visitor" ),

            "author"  => array(
                0 => "author",
                1 => "member",
                2 => "visitor" ),

            "member" => array(
                0 => "member",
                1 => "visitor" ),
            
            "visitor" => array(
                0 => "visitor")
        );
        
        if(in_array($permission,$roles[$_SESSION['user']['role']]))
        {
            echo "DROITS OK";
        }
        else
        {
            header("HTTP/1.0 404 Not Found");
            echo "ERREUR DROITS";
            die();
            //FIXME : ADD 404.tpl
        }
        
            
    }
    
    
    
    
    
}

