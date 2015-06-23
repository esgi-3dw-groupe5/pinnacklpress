<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

class Footer extends \sophwork\app\controller\AppController{
	
	public function __construct($config = null){
		parent::__construct();
		$this->config = $config;
		$this->forms = [];
		$this->fields = [];
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
		$this->setViewData('h2', 'Footer configuration');
		
		$footer = $KDM->create('pp_pagemeta');

		if($action == 'delete'){
			// $footer->find();
			// $this->callView($page, 'nimda/');
		}
		elseif($action == 'edit'){

			// $this->callView($page .'-edit', 'nimda/');
		}
		elseif($action == 'new'){
			$html = new htmlBuilder('[]');
			$layout = $html->createBuilder();
			$this->setRawData('layout', $layout);
			$this->callView($page .'-new', 'nimda/');
		}
		else{
			// $footer->find();

			$this->callView($page, 'nimda/');
		}
	}
}