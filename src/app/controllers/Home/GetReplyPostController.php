<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";
require_once SRC_ROOT_PATH . "/app/models/HomeModel.php";
class GetReplyPostController extends BaseController{
    protected static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(HomeModel::getInstance());
        }
        return self::$instance;
    }
    public function get($urlParams){
        $postid = $urlParams[1];
        $owner = $urlParams[0];
        $result = $this->srv->getReply($postid,$owner);
        if($result){
            echo json_encode($result);
        }
        else if($result == false){
            echo json_encode(array(
                'status' => 'kosong',
                'message' => 'error'
            ));
        }
    }
}

?>