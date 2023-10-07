<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once APP_ROOT_PATH . "/app/core/database.php";

class UserModel
{
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function getAllUser(){
        $db = Database::getInstance()->getPDO();
        $sql = "SELECT * FROM users";
        $result = $db->query($sql);
        $hasil = $result->fetchAll(PDO::FETCH_ASSOC);
        return $hasil;
    }



}

?>