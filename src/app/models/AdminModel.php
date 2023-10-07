<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once APP_ROOT_PATH . "/app/core/database.php";

class AdminModel
{
    protected static $instance;
    
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function banUser($user_id){
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "UPDATE users SET status = 'ban' WHERE id = '$user_id'";
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

    public function unbanUser($user_id){
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "UPDATE users SET status = null WHERE id = '$user_id'";
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

}

?>
