<?php
session_start();
$controllers = ["home", "access", "create", "posts", "admin"];
$controller = $controllers[0];


define("ROOT", dirname($_SERVER["SCRIPT_NAME"]). "/");

$url_parts = explode("/", $_SERVER["REQUEST_URI"]);

if(isset($url_parts[3]) && in_array($url_parts[3], $controllers)) {

  $controller = $url_parts[3];
}
require("controllers/".$controller.".php");

?>