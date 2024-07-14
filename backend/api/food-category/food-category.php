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

        if($connection !== null){
            
            $where = "status = 1";

            $data = $connection->getData("*", $this->tableName, "result", $where, 'category_name asc');

            if($data){
                
                return json_encode(array("status"=>true, "message"=>"Food Category List Fetchead Successfully", "data"=>$data));

            } else {
            
                return json_encode(array("status"=>true, "message"=>"Data is Empty", "data"=>[]));
            }

        }else{

            echo json_encode(array('status'=>false, 'message'=>'Failed to connect to the database', 'data'=>[]));
        
        }
    }
    
}

?>