<?php

require_once "./../index.php";

class FoodTerminology extends BaseController{

    private $tableName = "food_terminology";

    public function __construct(){
        parent::__construct();
    }

    /* API For List of All Food Terminology List */

    public function list() {
        
        $connection = $this->getDatabase();

        if($connection !== null){
            
            $where = $this->tableName.".status = 1";
            
            $join = "Join food_type on food_type.id = ".$this->tableName.".food_type_id ";

            $select = $this->tableName.".*, food_type.name as food_type";

            $data = $connection->getData($select, $this->tableName, "result", $where, 'id desc', $join);

            if($data){
                
                return json_encode(array("status"=>true, "message"=>"Food Terminology List Fetchead Successfully", "data"=>$data));

            } else {
            
                return json_encode(array("status"=>true, "message"=>"Data is Empty", "data"=>[]));
            }

        }else{

            echo json_encode(array('status'=>false, 'message'=>'Failed to connect to the database', 'data'=>[]));
        
        }
    }
    

    /* API For Add Food Terminology */

    public function storeFoodTerminologyData($requestdata) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            $update = $curdOperation->insertData($this->tableName, $requestdata);

            if($update){
                
                return json_encode(array("status"=>true, "message"=>"Food Terminology Added Successfully", "data"=>$requestdata));

            } else {
            
                return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }

    }
    

    /* API For Update Food Terminology */

    public function updateFoodTerminologyData($requestdata, $id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $curdOperation->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $curdOperation->getData("*", $this->tableName, "row", $where);
                        
                        return json_encode(array("status"=>true, "message"=>"Food Terminology Updated Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Terminology Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }


    /* API For Delete Food Terminology */

    public function deleteFoodTerminologyData($id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $curdOperation->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return json_encode(array("status"=>true, "message"=>"Food Terminology Deleted Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Terminology Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }

    /* API For Delete Food Item */

    public function singleData($id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if($id != ""){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    return json_encode(array("status"=>true, "message"=>"Food Terminology Get Successfully", "data"=>$data));

                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Terminology Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }
}

?>