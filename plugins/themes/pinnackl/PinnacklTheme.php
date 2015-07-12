<?php

namespace nimda\plugins\themes\pinnackl;

use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use nimda\controller\setup\Themes;

Class PinnacklTheme extends Themes{
	public $config;

	public function __construct($config = null){
		parent::__construct();
		$this->config = Sophwork::getConfig();
	}

	public function renderView($page = null, $path = null){
		$KDM = new SophworkDM($this->config);
		$options = $KDM->create('pp_option');
		// ...
	}
}