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
        $user = $this->KDM->create('pp_user');
        $user->findUserEmail($POST['name']);
        var_dump($user);
    }
    
    public function inscription($POST){
        var_dump($POST);
    }
    
    
    
    
    
}

