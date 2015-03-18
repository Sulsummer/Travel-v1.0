<?php
	function my_autoload($class){
		$classname = str_replace("\\", "/", $class).".php";
		require_once("$classname");
	}

	spl_autoload_register("my_autoload");
?>