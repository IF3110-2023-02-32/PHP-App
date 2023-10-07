<?php

require_once APP_ROOT_PATH . '/app/baseclasses/BaseModel.php';
require_once APP_ROOT_PATH . '/app/baseclasses/Database.php';

class LoginModel extends BaseModel
{
    protected static $instance;
    public $user_id;
    public $username;
    public $password;
    public $email;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    public $role;
    public $status;

    private function __construct()
    {
        $this->_attributes = ['user_id', 'username', 'password', 'email', 'created_at', 'updated_at', 'deleted_at', 'role', 'status'];
        $this->_primary_key = ['user_id'];
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function isAdmin(){
        return $_SESSION['role'] == 'admin';
    }

    public function isUser(){
        return $_SESSION['role'] == 'user';
    }

    public function isLogin(){
        return isset($_SESSION['id']);
    }

    public static function login($username, $password)
    {
        $konek = new Database();
        $db = $konek->pdo;
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password_hashed'])){
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                return $row['id'];
            }
            else{
                return null;
            }
            
        } else {
            return null;
        }
    }
    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['role']);
    }



}

?>