<?php

namespace nimda\controller\user;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

use nimda\controller\access\Controller;

use controller\utils\Users;

class UserHistory extends Controller{
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

        $userPage = Sophwork::getParam('p', '');
        $action = Sophwork::getParam('a', '');
        $edit = Sophwork::getParam('e', '');
        $elses = preg_split("#/#", $edit);
        
        Users::startSession();
        $user = new Users();
        
        $own = '';
        if(strtolower($user->url) == $userPage)
            $own = 'own-';

        $options = $KDM->create('pp_option');
        $options->findOptionName('siteurl');
        $siteurl = $options->getOptionValue()[0];

        $history = $KDM->create('pp_history');
        
        $this->setViewData('siteurl', $siteurl);
        $this->setViewData('h1', 'Pinnackl Press');
        $this->setViewData('h2', 'History');

        $history->findUserId($_SESSION['user']['id']);

        $this->setViewData('history', $history->getData(), 'history_id');
        $this->setViewData('history', $history->getData(), 'user_id');
        $this->setViewData('history', $history->getData(), 'post_id');        
        $this->setViewData('history', $history->getData(), 'history_date'); 
        $this->setViewData('history', $history->getData(), 'history_status');
        
        $this->callView('user/' . $own .'history','nimda/');

    }
}