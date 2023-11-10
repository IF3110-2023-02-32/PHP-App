<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once SRC_ROOT_PATH . "/app/core/PDOHandler.php";

class HomeModel 
{
    protected static $instance;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function getPostPage($page){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $page = $page * 10;
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,u.profile_picture_path,p.body,pr.path FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id ORDER BY p.post_id DESC LIMIT 10 OFFSET $page";
            $count = "SELECT COUNT(*) as count FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id ";
            $result = $db->query($sql);
            $result2 = $db->query($count);
            if($result){
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                $simpan = $result2->fetch(PDO::FETCH_ASSOC);
                $hasil = array(
                    'count' => $simpan['count'],
                    'data' => $data
                );
                return $hasil;
            }
            else{
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
        
    }
    public function likes($post_id,$owner){
        try{
            $user_id = $_SESSION['user_id'];
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "INSERT INTO likes (post_id,post_owner_id,user_id) VALUES ($post_id,$owner,$user_id)";
            $check = "SELECT * FROM likes WHERE post_id=$post_id AND post_owner_id=$owner AND user_id=$user_id";
            $result2 = $db->query($check);
            if($result2){
                $result = $result2->fetchAll(PDO::FETCH_ASSOC);
                if(count($result) > 0){
                    return false;
                }
                else{
                    $result = $db->query($sql);
                    if($result){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
            }
            else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}

?>