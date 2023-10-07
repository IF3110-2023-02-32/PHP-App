<?php

require_once APP_ROOT_PATH . "/app/controllers/BaseController.php";
require_once APP_ROOT_PATH . "/app/models/UserModel.php";

class UserController extends BaseController{
    protected static $instance;
    private function __construct($srv){
        parent::__construct($srv);
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(UserModel::getInstance());
        }
        return self::$instance;
    }
    public function get($urlParams){
        $hasil = $this->srv->getAllUser();
        if($hasil!=null){
            $hasiljson = array(
                'status' => 'sukses',
                'data' => json_encode($hasil)
            );
            return json_encode($hasiljson);
        }
        else{
            $hasiljson = array(
                'status' => 'error',
                'message' => 'Tidak ada user'
            );
            return json_encode($hasiljson);
            
        }
        
    }

}

?>