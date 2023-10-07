<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once APP_ROOT_PATH . "/app/core/database.php";

class UserModel
{
    public function isAdmin(){
        return $_SESSION['role'] == 'admin';
    }

    public function isUser(){
        return $_SESSION['role'] == 'user';
    }

    public function isLogin(){
        return isset($_SESSION['id']);
    }
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getAllUser(){
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "SELECT * FROM users";
            $result = $db->query($sql);
            $hasil = $result->fetchAll(PDO::FETCH_ASSOC);
            return $hasil;
        }catch(Exception $e){
            return null;
        }

    }
    public function getAllUserBan(){
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "SELECT * FROM users WHERE status = 'ban'";
            $result = $db->query($sql);
            $hasil = $result->fetchAll(PDO::FETCH_ASSOC);
            return $hasil;
        }catch(Exception $e){
            return null;
        }

    }
    public function getAllUserUnban(){
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "SELECT * FROM users WHERE status IS NULL";
            $result = $db->query($sql);
            $hasil = $result->fetchAll(PDO::FETCH_ASSOC);
            return $hasil;
        }catch(Exception $e){
            return null;
        }

    }



}

?>