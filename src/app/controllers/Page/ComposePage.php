<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";
class ComposePage extends BaseController{
    protected static $instance;

    public function __construct(){
        parent::__construct(null);
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function get($urlParams)
    {
        require SRC_ROOT_PATH . "/app/view/post.php";
        exit();
    }
}


?>