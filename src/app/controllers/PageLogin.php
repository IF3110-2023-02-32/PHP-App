<?php
require_once APP_ROOT_PATH . "/app/controllers/BaseController.php";
class LoginPage extends BaseController{
    protected static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function get($urlParams){
        require_once APP_ROOT_PATH . "/app/views/login.php";
        exit();
    }
}


?>