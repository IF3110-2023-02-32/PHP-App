<?php

class Database
{
    private static $instance;

    private $pdo;

    public function __construct()
    {
        $dsn = "pgsql:host=" . DBHOST .
               ";port=" . DBPORT .
               ";dbname=" . DBNAME .
               ";user=" . DBUSER .
               ";password=" . DBPASSWORD;
        
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $retry = CONNECT_RETRIES;
        while(retry){
            try {
                $retry--;
                $pdo = new PDO($dsn, $this->user, $this->password, $option);
            } catch (PDOException) {
                error_log('Retrying database connection (' . $retry . ')');
            }
            $retry = 0;
        }
        if(!isset($pdo)) {
            exit('[ERROR]: Could not connect to database. ' . $e);
        }

    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
          self::$instance = new static();
        }
        return self::$instance;
    }
}
