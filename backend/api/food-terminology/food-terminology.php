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

        if($connection === null){

            return Response::jsonResponse(false, 'Failed to connect to the database');

        }
            
        $where = $this->tableName.".status = 1";
        
        $join = "Join food_type on food_type.id = ".$this->tableName.".food_type_id ";

        $select = $this->tableName.".*, food_type.name as food_type";

        $data = $connection->getData($select, $this->tableName, "result", $where, 'id desc', $join);

        if(empty($data)){
        
            return Response::jsonResponse(true, "Data is Empty");;

        }
            
        return Response::jsonResponse(true, "Food Terminology List Fetchead Successfully", $data);

    }
    

    /* API For Add Food Terminology */

    public function storeFoodTerminologyData($requestdata) {
        
        $connection = $this->getDatabase();

        if ($connection === null) {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");

        }
            
        $update = $connection->insertData($this->tableName, $requestdata);

        if($update){
            
            return Response::jsonResponse(true, "Food Terminology Added Successfully", $requestdata);

        } else {
        
            return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
        }

    }
    

    /* API For Update Food Terminology */

    public function updateFoodTerminologyData($requestdata, $id) {
        
        $connection = $this->getDatabase();

        if ($connection === null) {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");

        }
            
        if(empty((int)$id)){
            
            return Response::jsonResponse(false, "Please Provide a Valid Id");

        }

        $where = "id = '" . $id ."'";
        
        $data = $connection->getData("*", $this->tableName, "row", $where);

        if(empty($data)){
            
            return Response::jsonResponse(false, "Food Terminology Not Found");
        
        }

        $update = $connection->updateData($this->tableName, $requestdata, $where);

        if($update){
        
            $resultData = $connection->getData("*", $this->tableName, "row", $where);
            
            return Response::jsonResponse(true, "Food Terminology Updated Successfully", $resultData);

        } else {
        
            return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
        }
    }


    /* API For Delete Food Terminology */

    public function deleteFoodTerminologyData($id) {
        
        $connection = $this->getDatabase();

        if ($connection === null) {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        }
            
        if(empty((int)$id)){
            
            return Response::jsonResponse(false, "Please Provide a Valid Id");

        }

        $where = "id = '" . $id ."'";
        
        $data = $connection->getData("*", $this->tableName, "row", $where);

        if(empty($data)){
            
            return Response::jsonResponse(false, "Food Terminology Not Found");

        }

        $delete = $connection->deleteData($this->tableName, $where);

        if(empty($delete)){
        
            return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");

        }
            
        return Response::jsonResponse(true, "Food Terminology Deleted Successfully");
    }

    /* API For Delete Food Item */

    public function singleData($id) {
        
        $connection = $this->getDatabase();

        if ($connection === null) {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");

        }
            
        if(empty($id)){
            
            return Response::jsonResponse(false, "Please Provide a Valid Id");

        }

        $where = "id = '" . $id ."'";
        
        $data = $connection->getData("*", $this->tableName, "row", $where);

        if(empty($data)){
            
            return Response::jsonResponse(false, "Food Terminology Not Found");

        }

        return Response::jsonResponse(true, "Food Terminology Get Successfully", $data);

    }
}

?>