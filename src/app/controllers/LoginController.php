<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseController.php";
require_once APP_ROOT_PATH . "/app/models/LoginModel.php";

class LoginController extends BaseController{
    protected static $instance;
    private function __construct($srv){
        parent::__construct($srv);
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(LoginModel::getInstance());
        }
        return self::$instance;
    }
    public function post($urlParams){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user_id = $this->srv->login($username, $password);
        if($user_id!=null){
            $hasiljson = array(
                'status' => 'sukses',
                'user_id' => $user_id
            );
            return json_encode($hasiljson);
        }
        else{
            $hasiljson = array(
                'status' => 'gagal',
                'message' => 'Username atau password salah'
            );
            return json_encode($hasiljson);
            
        }
    }

}




?>