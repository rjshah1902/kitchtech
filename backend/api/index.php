<?php

require_once "./../../constant/methods.php";

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


class BaseController {
    
    private $dbConnection;

    public function __construct() {
        $database = new Database();
        $this->dbConnection = $database->getConnection();
    }

    public function getDatabase() {

        if ($this->dbConnection !== null) {

            $curdOperation = new CurdOperation($this->dbConnection);

            return $curdOperation;

        } else {

            echo "Cannot perform database operations because the connection failed.";
        
        }
    }
}

?>