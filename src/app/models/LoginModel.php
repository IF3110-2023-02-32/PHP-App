<?php

require_once SRC_ROOT_PATH . "/app/baseclasses/BaseModel.php";
require_once SRC_ROOT_PATH . "/app/core/database.php";

class LoginModel 
{
    protected static $instance;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }



    public static function login($username, $password)
    {
        try{
            $db = Database::getInstance()->getPDO();
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $db->query($sql);
            $row = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                if(password_verify($password, $row[0]['password_hashed'])){
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    return $row[0]['role'];
                }
                else{
                    return null;
                }
        
                
            } else {
                return null;
            }
        }catch(Exception $e){
            return null;
        }
    }
    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['role']);
    }



}

?>