<?php

define('APP_ROOT_PATH', __DIR__);

require_once "app/config/config.php";
require_once APP_ROOT_PATH . "/app/router/PageRouter.php";
require_once APP_ROOT_PATH . "/routes.php";

$router = new PageRouter($routes);
$router->setErrorRoute("/public/view/404.php");
$router->routing($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
