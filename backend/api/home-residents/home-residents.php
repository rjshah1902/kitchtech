<?php

require_once "./../index.php";
require_once "./../response.php";

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
                
                return Response::jsonResponse(true, "Home Residents List Fetchead Successfully", $data);

            } else {
            
                return Response::jsonResponse(true, "Data is Empty");
            }

        }else{

            return Response::jsonResponse(false, 'Failed to connect to the database');
        
        }
    }
    

    /* API For Add Home Residents */

    public function storeResidentsData($requestdata) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            $update = $connection->insertData($this->tableName, $requestdata);

            if($update){
                
                return Response::jsonResponse(true, "Home Residents Added Successfully", $requestdata);

            } else {
            
                return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }

    }
    

    /* API For Update Home Residents */

    public function updateResidentsData($requestdata, $id) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $connection->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $connection->getData("*", $this->tableName, "row", $where);
                        
                        return Response::jsonResponse(true, "Home Residents Updated Successfully", $resultData);

                    } else {
                    
                        return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
                    }
                } else {
                    
                    return Response::jsonResponse(false, "Home Residents Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }


    /* API For Delete Home Residents */

    public function deleteResidentsData($id) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $connection->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return Response::jsonResponse(true, "Home Residents Deleted Successfully", $resultData);

                    } else {
                    
                        return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
                    }
                } else {
                    
                    return Response::jsonResponse(false, "Home Residents Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }

    /* API For Delete Food Item */

    public function singleData($id) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if($id != ""){

                $where = "id = '" . $id ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    return Response::jsonResponse(true, "Home Residents Get Successfully", $data);

                } else {
                    
                    return Response::jsonResponse(false, "Home Residents Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }
}

?>