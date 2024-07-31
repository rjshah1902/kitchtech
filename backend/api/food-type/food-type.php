<?php

require_once "./../index.php";

class FoodType extends BaseController{

    private $tableName = "food_type";

    public function __construct(){
        parent::__construct();
    }

    /* API For List of All Food Type List */

    public function list() {
        
        $connection = $this->getDatabase();

        if($connection !== null){
            
            $where = "status = 1";

            $data = $connection->getData("*", $this->tableName, "result", $where, 'id desc');

            if($data){
                
                return Response::jsonResponse(true, "Food Type List Fetchead Successfully", $data);

            } else {
            
                return Response::jsonResponse(true, "Data is Empty");
            }

        }else{

            return Response::jsonResponse(false, 'Failed to connect to the database');
        
        }
    }
    
}

?>