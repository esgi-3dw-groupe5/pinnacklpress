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

   
}