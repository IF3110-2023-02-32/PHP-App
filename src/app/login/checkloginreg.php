<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class LoginRegistrasi{
    function connect_db(): PDO{
        $host = "localhost";
        $dbname = "wbd";
        $username = "postgres";
        $password = "postgres";
        $port = "5432";

        $db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        return $db;
    }
    function login($db){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $koneksi = $db;
            $query = "SELECT * FROM users";
            $result = $koneksi->query($query);
            $data_database = $result->fetchAll();
        
            $data = json_decode(file_get_contents("php://input"));
            $path = $_SERVER['REQUEST_URI'];
            if(strpos($path,'/checkloginreg.php/login') !== false){
                if(!empty($data->username) && !empty($data->password)){
                    $username = $data->username;
                    $password = $data->password;
                    $get = 0;
                    for($i=0;$i<count($data_database);$i++){
                        if($data_database[$i]['username'] === $username && password_verify($password, $data_database[$i]['password_hashed'])){
                            $response = array("status" => "sukses", "message" => "Login berhasil", "role" => $data_database[$i]['role']);
                            $get = 1;
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            break;
                        }
                    }
                    if($get == 0){
                        $response = array("status" => "error", "message" => "Username atau password salah");
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    }
                }else{
                    $response = array("status" => "error", "message" => "Username atau password tidak boleh kosong");
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }
    }
    function registrasi($db){
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $koneksi = $db;
                $query = "SELECT * FROM users";
                $result = $koneksi->query($query);
                $data_database = $result->fetchAll();
            
                $data = json_decode(file_get_contents("php://input"));
                $path = $_SERVER['REQUEST_URI'];
                if(strpos($path,'/checkloginreg.php/register') !== false){
                    if(!empty($data->username) && !empty($data->password) && !empty($data->nama)){
                        $username = $data->username;
                        $password = $data->password;
                        $nama = $data->nama;
                        $get = 0;
                        for($i=0;$i<count($data_database);$i++){
                            if($data_database[$i]['username'] == $username){
                                $response = array("status" => "error", "message" => "Username sudah terdaftar");
                                $get = 1;
                                header('Content-Type: application/json');
                                echo json_encode($response);
                                break;
                            }
                                
                        }
                        if($get == 0){
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $query = "INSERT INTO users (username, password_hashed, profile_name, role) VALUES ('$username', '$password', '$nama', 'user')";
                            $result = $koneksi->query($query);
                            $response = array("status" => "sukses", "message" => "Registrasi berhasil");
                            header('Content-Type: application/json');
                            echo json_encode($response);
                        }
                        
                    }else{
                        $response = array("status" => "error", "message" => "Username atau password atau nama tidak boleh kosong");
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    }
                    
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

// $loginregistrasi = new LoginRegistrasi();
// $db = $loginregistrasi->connect_db();
// $loginregistrasi->login($db);
// $loginregistrasi->registrasi($db);


?>