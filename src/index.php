<?php

define('SRC_ROOT_PATH', __DIR__);
define('CONTROLLER_PATH', __DIR__ . '/app/controllers');
define('MIDDLEWARE_PATH', __DIR__ . '/app/middlewares');
define('PAGE_PATH', __DIR__ . '/app/view');


require_once "app/config/config.php";
require_once SRC_ROOT_PATH . "/app/router/Router.php";
require_once CONTROLLER_PATH . "/User/LoginController.php";
require_once CONTROLLER_PATH . "/User/RegisterController.php";
require_once CONTROLLER_PATH . "/Admin/AdminController.php";
require_once CONTROLLER_PATH . "/Admin/BanController.php";
require_once CONTROLLER_PATH . "/Admin/UnbanController.php";

require_once CONTROLLER_PATH . "/Page/LoginPage.php";
require_once CONTROLLER_PATH . "/Page/ComposePage.php";
require_once CONTROLLER_PATH . "/Page/SettingsPage.php";
require_once CONTROLLER_PATH . "/Page/UserPage.php";

$router = new Router();

// $router->addHandler("/example", BaseController::getInstance(), [BaseMiddleware::getInstance()]);
$router->addHandler("/api/login", LoginController::getInstance(), []);
$router->addHandler("/api/register", RegisterController::getInstance(), []);
$router->addHandler("/api/admin", AdminController::getInstance(), []);
$router->addHandler("/api/ban", BanController::getInstance(), []);
$router->addHandler("/api/unban", UnbanController::getInstance(), []);

$router->addHandler("/login", LoginPage::getInstance(), []);
$router->addHandler("/compose/kicau", ComposePage::getInstance(), []);
$router->addHandler("/settings/*", SettingsPage::getInstance(), []);
$router->addHandler("/*", UserPage::getInstance(), []);

$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);