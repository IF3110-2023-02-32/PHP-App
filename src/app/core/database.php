<?php

class Database
{
    private $host = 'localhost';
    private $db_name = DBNAME;
    private $user = DBUSER;
    private $password = DBPASSWORD;
    private $port = DBPORT;

    private $db_pdo_connection;

    private $statement;

    public function __construct()
    {
        $dsn = "pgsql:host=" . $this->host .
               ";port=" . $this->port .
               ";dbname=" . $this->dbname .
               ";user=" . $this->user .
               ";password=" . $this->password;
        
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->db_connection = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOException) {
            throw new LoggedException('Bad Gateway', 502);
        }
    }
}
