<?php

namespace controller\utils;

use sophwork\core\Sophwork;
use nimda\mail\Mail;
    
class Users extends \sophwork\app\controller\AppController {
    
    protected $user;
    
    public function __construct(){
        parent::__construct();
        $this->user = $this->KDM->create('pp_user');
        return $this->user;
    }
    
    public function __get($param){
        self::startSession();
        if(isset($_SESSION['user'][$param]))
            return $_SESSION['user'][$param];
        else
            return null;
    }

    public static function sessionStarted(){
        if(session_status() == PHP_SESSION_NONE)
            return false;
        return true;
    }

    public static function startSession(){
        if(session_status() == PHP_SESSION_NONE)
            session_start();
    }

    public function connection($POST, $redirectAfterConnection = true){
        $this->user = $this->KDM->create('pp_user');
        $this->user->findUserEmail($POST['email']);
        $_SESSION['form']['error'] = [];
        if($this->user->getUserId()[0]!=null)
        {

            if(password_verify($POST['password'], $this->user->getUserPassword()[0]))
            {
                $_SESSION['user']['id']=$this->user->getUserId()[0];
                $_SESSION['user']['email']=$this->user->getUserEmail()[0];
                $_SESSION['user']['pseudo']=$this->user->getUserPseudo()[0];
                $_SESSION['user']['role']=$this->user->getUserRole()[0];
                $_SESSION['user']['connected']=true;
                
                if($redirectAfterConnection) {
                    Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
                    exit;
                }
            }
            else
            {
                $_SESSION['form']['error'][]="Le mot de passe est incorrect";
                Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
                exit;
            }
        }
        else
        {
            $_SESSION['form']['error'][]="Ce mail n'existe pas";
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
            
            $userkey = md5(microtime().rand());
            
            $this->user->setUserEmail($POST['email']);
            $this->user->setUserPassword($hash_psw);
            $this->user->setUserPseudo($POST['pseudo']);
            $this->user->setUserGender('2');//FIX ME
            $this->user->setUserFirstname($POST['firstname']);
            $this->user->setUserName($POST['lastname']);
            $this->user->setUserBdate($POST['birthdate']);
            $this->user->setUserRegdate(date("Y-m-d h:i:s"));
            $this->user->setUserRole('member');
            $this->user->setUserKey($userkey);
            $this->user->setUserActive('0');
            $this->user->setUserUrl($POST['pseudo']);

            if($this->user->save()){
                Mail::sendMail($POST['pseudo'],$POST['email'],$POST['firstname'],$userkey);
            }
        }
        else{
            $_SESSION['form']['error'][]="L'utilisateur existe déjà";
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
    }
    
    public function initUser(){
        $_SESSION['user']['pseudo']     = null;
        $_SESSION['user']['email']      = null;
        $_SESSION['user']['role']       = 'visitor';
        $_SESSION['user']['connected']  = false;
    }
    
    public function logout(){
        session_destroy();
        Sophwork::redirect();
        exit;
    }

}

