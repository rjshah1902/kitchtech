<?php

require_once "constant.php";

class Database{

    private $host = HOSTNAME;

    private $username = USERNAME;

    private $password = PASSWORD;

    private $database = DATABASE;

    public $connection;

    public function getConnection(){

        $this->connection = null;

        /* Connect to database */
        
        try{
         
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

        }catch(PDOException $exception){
            
            echo "Connection error: " . $exception->getMessage();
        
        }

        return $this->connection;
    }
}

?>