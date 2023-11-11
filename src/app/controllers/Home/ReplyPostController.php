<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseController.php";
require_once SRC_ROOT_PATH . "/app/models/HomeModel.php";
class ReplyPostController extends BaseController{
    protected static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static(HomeModel::getInstance());
        }
        return self::$instance;
    }
    public function post($urlParams){
        $postid = $urlParams[1];
        $owner = $urlParams[0];
        $body = $_POST['body'];
        $result = $this->srv->replyPost($postid,$owner,$body);
        if($result){
            return json_encode(array(
                'status' => 'success',
                'message' => 'reply success'
            ));
        }
        else{
            return json_encode(array(
                'status' => 'failed',
                'message' => 'Cannot reply own post'
            ));
        }
    }
}

?>