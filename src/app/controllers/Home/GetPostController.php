<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";
require_once SRC_ROOT_PATH . "/app/models/HomeModel.php";
class GetPostController extends BaseController{
    protected static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(HomeModel::getInstance());
        }
        return self::$instance;
    }
    public function get($urlParams){
        $page = $urlParams[0];
        $data = $this->srv->getPostPage($page);
        if($data!=null){
            $hasiljson = array(
                'status' => 'sukses',
                'message' => 'Berhasil mendapatkan post',
                'data' => $data
            );
            header('Content-Type: application/json');
            return json_encode($hasiljson);
        }
        else{
            $hasiljson = array(
                'status' => 'error',
                'message' => 'Gagal mendapatkan post'
            );
            header('Content-Type: application/json');
            return json_encode($hasiljson);
            
        }
    }
}

?>