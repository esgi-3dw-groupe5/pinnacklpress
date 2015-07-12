<?php

namespace nimda\controller\setup;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use sophwork\modules\htmlElements\htmlBuilder;
use sophwork\modules\htmlElements\htmlElement;

use nimda\controller\util\PluginHelper;

class Plugins extends \sophwork\app\controller\AppController{
	public function __construct($config = null){
		parent::__construct();
		$this->config = $config;
	}

	public function __get($param){
		return $this->$param;
	}

	public function __set($param, $value){
		$this->$param = $value;
	}

	public function renderView($page = null, $path = null){
		$KDM = new SophworkDM($this->config);
		$options = $KDM->create('pp_option');
		$this->setViewData('h1', 'Pinnackl Press');
		$this->setViewData('h2', 'Plugins configuration');

		$installedPlugins = PluginHelper::loadPlugins();
		$this->setRawData('plugins', $installedPlugins);

		$this->callView($page, 'nimda/');
	}
}