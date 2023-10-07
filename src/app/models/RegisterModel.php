<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once APP_ROOT_PATH . "/app/core/database.php";

class RegisterModel
{
    protected static $instance;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }


    public static function register($username, $password, $nama)
    {
        try{
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $db = Database::getInstance()->getPDO();
            $sql = "INSERT INTO users (username, password_hashed, profile_name, role) VALUES ('$username', '$hashpass', '$nama', 'user')";
            $result = $db->query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
}
?>