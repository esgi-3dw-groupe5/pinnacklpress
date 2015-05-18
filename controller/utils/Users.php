<?php

namespace controller\utils;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Users extends \sophwork\app\controller\AppController {
    
    protected $user;
    
    public function __construct(){
        parent::__construct();
        $this->user = $this->KDM->create('pp_user');
    }
    
    public function connection($POST){
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['name']);
        if($this->user->getUserId()[0]!=null)
        {
            if($this->user->getUserPassword()[0]==$POST['password'])
            {
                session_start();
                $_SESSION['email']=$user->getUserEmail[0];
                $_SESSION['pseudo']=$user->getUserPseudo[0];
            }
        }
        var_dump($this->user);
    }
    
    public function inscription($POST){
        var_dump($POST);
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['name']);
        if($this->user->getUserId()[0]!=null)
        {
            if($this->user->getUserEmail()[0]==$POST['name'])
            {
                $this->user->setUserEmail($POST['name']);
                $this->user->setUserPassword($POST['password']);
                $this->user->setUserPseudo('plopPseudo');
                $this->user->setUserGender('1');
                $this->user->setUserFirstName('Lorem');
                $this->user->setUserName('Ipsum');
                $this->user->setUserBdate('1990-10-20');
                $this->user->setUserRole('Viewer');
                $this->user->setUserKey('azerty123');
                $this->user->setUserActive('0');
                $this->user->setUserUrl('Lorem-Ipsum');
            }
        }
        var_dump($this->user);
        
    }
    
    
    
    
    
}

