<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

class Users extends \sophwork\app\controller\AppController{
    public $config;
    protected $forms;
    protected $fields;

    public function __construct($config = null){
        parent::__construct();
        $this->config = $config;
        $this->forms = [];
        $this->fields = [];
    }

    public function __get($param){
        return $this->$param;
    }

    public function __set($param, $value){
        $this->$param = $value;
    }

    public function __getForms($param){
        return $this->forms[$param];
    }

    public function __setForms($param, $value){
        $this->forms[$param] = $value;
    }

    public function __getFields($param){
        return $this->fields[$param];
    }

    public function __setFields($param, $value){
        $this->fields[$param] = $value;
    }

    public function renderView($page = null, $path = null){
        $KDM = new SophworkDM($this->config);
        $action = Sophwork::getParam('a', '');
        $edit = Sophwork::getParam('e', '');

        $options = $KDM->create('pp_option');
        $options->findOptionName('siteurl');
        $siteurl = $options->getOptionValue()[0];

        $this->setViewData('siteurl', $siteurl);
        $this->setViewData('h1', 'Pinnackl Press');
        $this->setViewData('h2', 'Users Management');

        $user = $KDM->create('pp_user');

        if($action == 'delete'){
            $user->find();
            $this->setViewData('users', $user->getData(), 'user_id');
            $this->setViewData('users', $user->getData(), 'user_pseudo');
            $this->setViewData('users', $user->getData(), 'user_email');
            $this->setViewData('users', $user->getData(), 'user_role');

            $this->callView($page, 'nimda/');
        }
        elseif($action == 'edit'){

            $user->findUserId($edit);

            $this->setViewData('user_pseudo', ''.$user->getUserPseudo()[0]);
            $this->setViewData('user_email', ''.$user->getUserEmail()[0]);
            $this->setViewData('user_role', ''.$user->getUserRole()[0]);

            $contents->findUserId($user->getUserId()[0]);
            if(!is_null($contents->getPmetaId()[0])){
                $data = $contents->getData()['pmeta_value'][0];
                $html = new htmlBuilder($data);
                $layout = $html->createBuilder();
                $this->setRawData('layout', $layout);
            }
            else{
                $html = new htmlBuilder('[]');
                $layout = $html->createBuilder();
                $this->setRawData('layout', $layout);
            }

            $this->callView($page .'-edit', 'nimda/');
        }
        else{
            $user->find();
            $this->setViewData('users', $user->getData(), 'user_id');
            $this->setViewData('users', $user->getData(), 'user_pseudo');
            $this->setViewData('users', $user->getData(), 'user_email');
            $this->setViewData('users', $user->getData(), 'user_role');

            $this->callView($page, 'nimda/');
        }
    }
}