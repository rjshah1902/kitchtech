<?php

require_once "./../index.php";

class FoodCategory extends BaseController{

    private $tableName = "food_category";

    public function __construct(){
        parent::__construct();
    }

    /* API For List of All Food Category List */

    public function list() {
        
        $connection = $this->getDatabase();
    
        if ($connection === null) {
        
            return Response::jsonResponse(false, 'Failed to connect to the database');
        
        }
    
        $where = "status = 1";
        
        $data = $connection->getData("*", $this->tableName, "result", $where, 'category_name asc');
    
        if (!$data) {
        
            return Response::jsonResponse(true, "Data is Empty");
        
        }
    
        return Response::jsonResponse(true, "Food Category List Fetched Successfully", $data);
    }
    
}

?>