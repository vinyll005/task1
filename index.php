<?php
define('ROOT', __DIR__);
include_once(ROOT.'/components/autoloader.php');
include_once(ROOT.'/components/routes.php');

session_start();

$router = new Router($routes);

$router->run();
?>