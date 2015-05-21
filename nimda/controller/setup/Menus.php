<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

class Menus extends \sophwork\app\controller\AppController{
	
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

		$menus = $KDM->create('pp_menu');
		$menuRs = $KDM->create('pp_menu_rs');
		$pages = $KDM->create('pp_page');

		$this->setViewData('siteurl', $siteurl);
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Menus configuration');

		if($action == 'delete'){
			$menus->find();
			$this->setViewData('menus', $menus->getData(), 'menu_id');
			$this->setViewData('menus', $menus->getData(), 'menu_name');
			$this->setViewData('menus', $menus->getData(), 'menu_status');

			$this->callView($page, 'nimda/');
		}
		elseif($action == 'edit'){ // FIXME : better handle blank cases
			$menus->findMenuId($edit);
			$this->setViewData('menu_name', ''.$menus->getMenuName()[0]);
			$this->setViewData('menu_status', ''.$menus->getMenuStatus()[0]);

			$pages->find();
			$this->setViewData('pages', $pages->getData(), 'page_id');
			$this->setViewData('pages', $pages->getData(), 'page_name');

			$menuRs->findMenuId($edit);
			$linkedPage = $menuRs->getPageId();
			if(is_null($linkedPage)){
				$linkedPage = [];
			}
			else{
				$this->setViewData('menus', $menuRs->getData(), 'menu_rs_id');
			}
			$this->setRawData('linked' ,$linkedPage);

			$this->callView($page .'-edit', 'nimda/');
		}
		elseif($action == 'new'){
			$this->callView($page .'-new', 'nimda/');
		}
		else{
			$menus->find();
			$this->setViewData('menus', $menus->getData(), 'menu_id');
			$this->setViewData('menus', $menus->getData(), 'menu_name');
			$this->setViewData('menus', $menus->getData(), 'menu_status');

			$this->callView($page, 'nimda/');
		}
	}
}