<?php

require_once "./../index.php";

class FoodItems extends BaseController{

    private $tableName = "food_items";

    public function __construct(){
        parent::__construct();
    }

    /* API For List of All Food Item List */

    public function list($search = "") {
        
        $connection = $this->getDatabase();

        if($connection !== null){
            
            $where = $this->tableName.".status = 1";
            
            if( isset($search) && $search != ""){

                $where .= " AND ".$this->tableName.".food_name LIKE '%".$search."%'";
            
            }

            $join = "Join food_terminology on food_terminology.id = ".$this->tableName.".food_terminology_id Join food_category on food_category.id = ".$this->tableName.".food_category_id Join food_type on food_type.id = ".$this->tableName.".food_type_id ";

            $select = $this->tableName.".*, food_terminology.terminology_name, food_category.category_name, food_type.name as food_type";

            $data = $connection->getData($select, $this->tableName, "result", $where, 'id desc', $join);

            if($data){
                
                return json_encode(array("status"=>true, "message"=>"Food Item List Fetchead Successfully", "data"=>$data));

            } else {
            
                return json_encode(array("status"=>true, "message"=>"Data is Empty", "data"=>[]));
            }

        }else{

            echo json_encode(array('status'=>false, 'message'=>'Failed to connect to the database', 'data'=>[]));
        
        }
    }
    

    /* API For Add Food Item */

    public function storeFoddItemData($requestdata) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            $update = $curdOperation->insertData($this->tableName, $requestdata);

            if($update){
                
                return json_encode(array("status"=>true, "message"=>"Food Item Added Successfully", "data"=>$requestdata));

            } else {
            
                return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }

    }
    

    /* API For Update Food Item */

    public function updateFoddItemData($requestdata, $id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $curdOperation->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $curdOperation->getData("*", $this->tableName, "row", $where);
                        
                        return json_encode(array("status"=>true, "message"=>"Food Item Updated Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Item Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }


    /* API For Delete Food Item */

    public function deleteFoddItemData($id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $curdOperation->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return json_encode(array("status"=>true, "message"=>"Food Item Deleted Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Item Not Found", "data"=>[]));
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

                    return json_encode(array("status"=>true, "message"=>"Food Item Get Successfully", "data"=>$data));

                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Food Item Not Found", "data"=>[]));
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