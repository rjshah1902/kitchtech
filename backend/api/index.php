<?php

require_once "./../../constant/methods.php";

$allowed_origins = [
    "http://localhost:3000",
    "https://kitchtech.vercel.app"
];

header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
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

            $crud_operation = new CrudOperation($this->dbConnection);

            return $crud_operation;

        } else {

            echo "Cannot perform database operations because the connection failed.";
        
        }
    }
}

?>