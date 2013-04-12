<?php
	/**
	* Application类
	* 执行程序初始化、加载相关文件。
	*/
	class Application
	{
		public static function Initialize()
		{
			define("APP_PATH", dirname(__FILE__));
			//set_include_path(get_include_path().PATH_SEPARATOR);
			set_include_path(APP_PATH.DIRECTORY_SEPARATOR.'Core'.PATH_SEPARATOR);
			set_include_path(get_include_path().APP_PATH.DIRECTORY_SEPARATOR.'Controlor'.PATH_SEPARATOR);
			set_include_path(get_include_path().APP_PATH.DIRECTORY_SEPARATOR.'Mapping'.PATH_SEPARATOR);
			set_include_path(get_include_path().APP_PATH.DIRECTORY_SEPARATOR.'Model'.PATH_SEPARATOR);
			set_include_path(get_include_path().APP_PATH.DIRECTORY_SEPARATOR.'Smarty'.PATH_SEPARATOR);
			//require_once "Configuration.php";
			//require_once APP_PATH."/Core/Router.php";
		}
		public static function Run()
		{
			$Router = new Router();
			$Router->Route();
		}
	}
	function __autoload($class)
	{
		//echo "{$class}";
		require_once "{$class}.php";
	}
?>