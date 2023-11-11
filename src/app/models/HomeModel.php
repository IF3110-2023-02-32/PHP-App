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
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,u.profile_picture_path,p.body,pr.path FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.refer_type IS NULL ORDER BY p.post_id DESC LIMIT 10 OFFSET $page";
            $count = "SELECT COUNT(*) as count FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.refer_type IS NULL";
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
    public function plusView($post_id,$owner){
        try{
            $idnow = $_SESSION['user_id'];
            if($idnow!=$owner){
                $db = PDOHandler::getInstance()->getPDO();
                $sql = "UPDATE posts SET views=views+1 WHERE post_id=$post_id AND owner_id=$owner";
                $result = $db->query($sql);
                if($result){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return "akunsama";
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function getPostByID($post_id,$owner){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,u.profile_picture_path,p.body,pr.path FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.post_id=$post_id AND p.owner_id=$owner";
            $result = $db->query($sql);
            if($result){
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            else{
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function replyPost($post_id,$owner,$body){
        try{
            $user_id = $_SESSION['user_id'];
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "INSERT INTO posts(owner_id,body,refer_type,refer_post,refer_post_owner) VALUES ($user_id,'$body','Reply',$post_id,$owner) ";
            $result = $db->query($sql);
            if($result){
                return true;
            }
            else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function getReply($post_id,$owner){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,u.profile_picture_path,p.body,pr.path FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.refer_type='Reply' AND p.refer_post=$post_id AND p.refer_post_owner=$owner";
            $result = $db->query($sql);
            if($result){
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                return $data;
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