<?php
	function config_autoload($class){
		$classname = str_replace("\\", "/", $class).".php";
		require_once($classname);
	}

	function demo_autoload($class){
		$classname = str_replace("\\", "/", $class).".php";
		require_once($classname);
	}

	spl_autoload_register("config_autoload");
	spl_autoload_register("demo_autoload");



?>