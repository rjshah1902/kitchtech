<?php

require_once "./../index.php";

class HomeResidents extends BaseController{

    private $tableName = "home_residents";

    public function __construct(){
        parent::__construct();
    }

    /* API For List of All Home Residents List */

    public function list() {
        
        $connection = $this->getDatabase();

        if($connection !== null){
            
            $where = $this->tableName.".status = 1";
            
            $join = "Join food_terminology on food_terminology.id = ".$this->tableName.".food_terminology_id Join food_type on food_type.id = ".$this->tableName.".food_type_id ";

            $select = $this->tableName.".*, food_terminology.terminology_name, food_type.name as food_type";
                
            $data = $connection->getData($select, $this->tableName, "result", $where, 'id desc', $join);
            
            if($data){
                
                return json_encode(array("status"=>true, "message"=>"Home Residents List Fetchead Successfully", "data"=>$data));

            } else {
            
                return json_encode(array("status"=>true, "message"=>"Data is Empty", "data"=>[]));
            }

        }else{

            echo json_encode(array('status'=>false, 'message'=>'Failed to connect to the database', 'data'=>[]));
        
        }
    }
    

    /* API For Add Home Residents */

    public function storeResidentsData($requestdata) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            $update = $curdOperation->insertData($this->tableName, $requestdata);

            if($update){
                
                return json_encode(array("status"=>true, "message"=>"Home Residents Added Successfully", "data"=>$requestdata));

            } else {
            
                return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }

    }
    

    /* API For Update Home Residents */

    public function updateResidentsData($requestdata, $id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $curdOperation->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $curdOperation->getData("*", $this->tableName, "row", $where);
                        
                        return json_encode(array("status"=>true, "message"=>"Home Residents Updated Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Home Residents Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }


    /* API For Delete Home Residents */

    public function deleteResidentsData($id) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $curdOperation->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return json_encode(array("status"=>true, "message"=>"Home Residents Deleted Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Home Residents Not Found", "data"=>[]));
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

                    return json_encode(array("status"=>true, "message"=>"Home Residents Get Successfully", "data"=>$data));

                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"Home Residents Not Found", "data"=>[]));
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