<?php
//define("BASEDIR", __DIR__);
//include BASEDIR."/Configuration/AutoLoader.php";
//spl_autoload_register("\\Configuration\\AutoLoader::autoload");
require_once("Configuration.php");

//$db = Configuration\MySQL::getInstance();
//$link = new Configuration\MySQL();
$tourist = new Demo\Tourist();
$tourist -> signUp("s","s","s");


?>