<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

class Footers extends \sophwork\app\controller\AppController{
	
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
		
		$footer = $KDM->create('pp_page');
		$contents = $KDM->create('pp_pagemeta');

		if($action == 'delete'){
			// $footer->find();
			// $this->callView($page, 'nimda/');
		}
		elseif($action == 'edit'){

			$footer->findPageId($edit);

			$this->setViewData('page_name', ''.$footer->getPageName()[0]);
			$this->setViewData('page_connectedAs', ''.$footer->getPageConnectedAs()[0]);
			$this->setViewData('page_status', ''.$footer->getPageStatus()[0]);
			
			$contents->findPageId($footer->getPageId()[0]);
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
		elseif($action == 'new'){
			$this->callView($page .'-new', 'nimda/');
		}
		else{
			$footer->findPageType('footer');
			$this->setViewData('footers', $footer->getData(), 'page_id');
			$this->setViewData('footers', $footer->getData(), 'page_name');
			$this->setViewData('footers', $footer->getData(), 'page_connectedAs');
			$this->setViewData('footers', $footer->getData(), 'page_status');
			
			$this->callView($page, 'nimda/');
		}
	}
}