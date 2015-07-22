<?php

namespace nimda\controller\util;
use sophwork\core\Sophwork;
use nimda\controller\util\PluginHelper;

Class PluginHelper{

	public static function checkPlugins(){
		$plugins = @file_get_contents( __DIR__ . '/../../../plugins/plugins.json');
		if($plugins !== false){
			$plugins = json_decode($plugins, true);
			if(!empty($plugins)){
				return 'plugins';
			}
		}
		return null;
	}
	
	public static function loadPlugins($mode = true){
		$plugins = @file_get_contents( __DIR__ . '/../../../plugins/plugins.json');
		if($plugins !== false){
			if(self::checkPlugins() == 'plugins'){
				$plugins = json_decode($plugins, $mode);
					return $plugins;
			}
		}
		return null;
	}
}