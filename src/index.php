<?php

define('APP_ROOT_PATH', __DIR__);

require_once "app/config/config.php";
require_once APP_ROOT_PATH . "/app/router/Router.php";
require_once APP_ROOT_PATH . "/app/controllers/LoginController.php";
require_once APP_ROOT_PATH . "/app/controllers/PageLogin.php";
require_once APP_ROOT_PATH . "/app/controllers/RegisterController.php";
require_once APP_ROOT_PATH . "/app/controllers/AdminController.php";
require_once APP_ROOT_PATH . "/app/controllers/BanController.php";
require_once APP_ROOT_PATH . "/app/controllers/UnbanController.php";
$router = new Router();

// $router->addHandler("/example", BaseController::getInstance(), [BaseMiddleware::getInstance()]);
$router->addHandler("/api/login", LoginController::getInstance(), []);
$router->addHandler("/login", LoginPage::getInstance(), []);
$router->addHandler("/api/register", RegisterController::getInstance(), []);
$router->addHandler("/api/admin", AdminController::getInstance(), []);
$router->addHandler("/api/ban", BanController::getInstance(), []);
$router->addHandler("/api/unban", UnbanController::getInstance(), []);

$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);