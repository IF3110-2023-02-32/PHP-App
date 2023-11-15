<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once SRC_ROOT_PATH . "/app/core/PDOHandler.php";

class GetPostModel
{
    protected static $instance;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getFollows($id){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "SELECT DATE(created_at) as day, COUNT(followed_user_id) as total from follows WHERE followed_user_id=$id GROUP BY day ORDER BY day DESC LIMIT 7;";
            $result = $db->query($sql);
            if($result){
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
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
    public function getDataPostByOwner($owner){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,p.body,pr.path,p.created_at FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.owner_id=$owner AND p.refer_type IS NULL ";
            $result = $db->query($sql);
            $sql2 = "SELECT DATE(created_at) as day, COUNT(post_id) as total from posts WHERE refer_post_owner=$owner AND refer_type='Reply' GROUP BY day ORDER BY day DESC LIMIT 7";
            $result2 = $db->query($sql2);
            $sql3 = "SELECT DATE(created_at) as day, COUNT(post_id) as total from likes WHERE post_owner_id=$owner GROUP BY day ORDER BY day DESC LIMIT 7";
            $result3 = $db->query($sql3);
            $sql4 = "SELECT DATE(created_at) as day, SUM(views) as total from posts WHERE owner_id=$owner GROUP BY day ORDER BY day DESC LIMIT 7";
            $result4 = $db->query($sql4);
            if($result){
                if($result2){
                    if($result3){
                        if($result4){
                            $data = $result->fetchAll(PDO::FETCH_ASSOC);
                            $data2 = $result2->fetchAll(PDO::FETCH_ASSOC);
                            $data3 = $result3->fetchAll(PDO::FETCH_ASSOC);
                            $data4 = $result4->fetchAll(PDO::FETCH_ASSOC);
                            return array(
                                'post' => $data,
                                'reply' => $data2,
                                'likes' => $data3,
                                'view' => $data4
                            );
                        }
                        else{
                            return null;
                        }
                    }
                    else{
                        return null;
                    }
                }
                else{
                    return null;
                }
            }
            else{
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function getDataPostIDByOwner($owner,$post_id){
        try{
            $db = PDOHandler::getInstance()->getPDO();
            $sql = "SELECT p.post_id,u.id,u.username,u.profile_name,p.body,pr.path,p.created_at FROM posts as p LEFT JOIN post_resources as pr ON p.post_id=pr.post_id AND p.owner_id=pr.post_owner_id JOIN users as u ON p.owner_id=u.id WHERE p.owner_id=$owner AND p.post_id=$post_id AND p.refer_type IS NULL ";
            $result = $db->query($sql);
            $sql2 = "SELECT DATE(created_at) as day, COUNT(post_id) as total from posts WHERE refer_post_owner=$owner AND refer_post=$post_id AND refer_type='Reply' GROUP BY day ORDER BY day DESC LIMIT 7";
            $result2 = $db->query($sql2);
            $sql3 = "SELECT DATE(created_at) as day, COUNT(post_id) as total from likes WHERE post_owner_id=$owner AND post_id=$post_id GROUP BY day ORDER BY day DESC LIMIT 7";
            $result3 = $db->query($sql3);
            $sql4 = "SELECT DATE(created_at) as day, views as total from posts WHERE owner_id=$owner AND post_id=$post_id";
            $result4 = $db->query($sql4);
            if($result){
                if($result2){
                    if($result3){
                        if($result4){
                            $data = $result->fetch(PDO::FETCH_ASSOC);
                            $data2 = $result2->fetchAll(PDO::FETCH_ASSOC);
                            $data3 = $result3->fetchAll(PDO::FETCH_ASSOC);
                            $data4 = $result4->fetch(PDO::FETCH_ASSOC);
                            return array(
                                'post' => $data,
                                'reply' => $data2,
                                'likes' => $data3,
                                'view' => $data4
                            );
                        }
                        else{
                            return null;
                        }
                    }
                    else{
                        return null;
                    }
                }
                else{
                    return null;
                }
            }
            else{
                return null;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
    }
}

?>