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
                
                return json_encode(array("status"=>true, "message"=>"Food Type List Fetchead Successfully", "data"=>$data));

            } else {
            
                return json_encode(array("status"=>true, "message"=>"Data is Empty", "data"=>[]));
            }

        }else{

            echo json_encode(array('status'=>false, 'message'=>'Failed to connect to the database', 'data'=>[]));
        
        }
    }
    
}

?>