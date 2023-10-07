<?php

define('APP_ROOT_PATH', __DIR__);

require_once "app/config/config.php";
require_once APP_ROOT_PATH . "/app/router/Router.php";
require_once APP_ROOT_PATH . "/routes.php";
require_once APP_ROOT_PATH . "/app/controllers/LoginController.php";
require_once APP_ROOT_PATH . "/app/controllers/PageLogin.php";

$router = new Router();

// $router->addHandler("/example", BaseController::getInstance(), [BaseMiddleware::getInstance()]);
$router->addHandler("/example", LoginController::getInstance(), []);
$router->addHandler("/login", LoginPage::getInstance(), []);

$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);