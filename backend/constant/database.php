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

        $this->connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        
        if ($this->connection === false) {

            error_log("Connection error: " . mysqli_connect_error());
        
        }

        return $this->connection;
    }
}

?>