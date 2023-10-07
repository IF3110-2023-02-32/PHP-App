<?php

require_once APP_ROOT_PATH . "/app/baseclasses/BaseModel.php";

class RegisterModel extends BaseModel
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


    public static function register($username, $password, $nama)
    {
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        $konek = new Database();
        $db = $konek->pdo;
        $sql = "INSERT INTO users (username, password_hashed, profile_name, role) VALUES ('$username', '$hashpass', '$nama', 'user')";
        $result = $db->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>