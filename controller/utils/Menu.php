<?php

namespace controller\utils;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Menu extends \sophwork\app\controller\AppController {
	protected $menu;
	protected $menuContent;
	protected $pageLinks;
	protected $links;

	public function __construct(){
		parent::__construct();
		$this->menu = $this->KDM->create('pp_menu');
		$this->menuContent = $this->KDM->create('pp_menu_rs');
		$this->pageLinks = $this->KDM->create('pp_page');
		$this->links = [];
	}

	public function create($menu){
		$this->menu->findMenuStatus($menu);
		$this->menuContent->findMenuId($this->menu->getMenuId()[0]);
		$menuLinks = $this->menuContent->getData();
		foreach ($menuLinks['page_id'] as $key => $value) {
			$this->pageLinks->find($value);
			if(isset($this->links[$this->pageLinks->getPageOrder()[0]]))
				$this->links[$this->pageLinks->getPageOrder()[0]+1] = ['link' => $this->pageLinks->getPageTag()[0], 'name' => $this->pageLinks->getPageName()[0]];
			else
				$this->links[$this->pageLinks->getPageOrder()[0]] = ['link' => $this->pageLinks->getPageTag()[0], 'name' => $this->pageLinks->getPageName()[0]];
		}
		ksort ($this->links);
		return $this->links;
	}
}