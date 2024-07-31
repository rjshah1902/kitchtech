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
    
        if ($connection === null) {

            return Response::jsonResponse(false, 'Failed to connect to the database');
        
        }
    
        $where = $this->tableName . ".status = 1";
        
        if (!empty($search)) {
            
            $where .= " AND " . $this->tableName . ".food_name LIKE '%" . $connection->escapeString($search) . "%'";
        
        }
    
        $join = "JOIN food_terminology ON food_terminology.id = " . $this->tableName . ".food_terminology_id ";

        $join .= "JOIN food_category ON food_category.id = " . $this->tableName . ".food_category_id ";
        
        $join .= "JOIN food_type ON food_type.id = " . $this->tableName . ".food_type_id";
    
        $select = $this->tableName . ".*, food_terminology.terminology_name, food_category.category_name, food_type.name as food_type";
    
        $data = $connection->getData($select, $this->tableName, "result", $where, 'id desc', $join);
    
        if (empty($data)) {

            return Response::jsonResponse(true, "Data is Empty");
        
        }
    
        return Response::jsonResponse(true, "Food Item List Fetched Successfully", $data);
    }
    

    /* API For Add Food Item */

    public function storeFoddItemData($requestdata) {
        
        $connection = $this->getDatabase();

        if ($connection === null) {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }

        $cehck = $connection->insertData($this->tableName, $requestdata);

        if (empty($cehck)) {
            
            return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");

        }

        return Response::jsonResponse(true, "Food Item Added Successfully", $requestdata);

    }
    

    /* API For Update Food Item */

    public function updateFoddItemData($requestdata, $id) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $connection->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $connection->getData("*", $this->tableName, "row", $where);
                        
                        return Response::jsonResponse(true, "Food Item Updated Successfully", $resultData);

                    } else {
                    
                        return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
                    }
                } else {
                    
                    return Response::jsonResponse(false, "Food Item Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }


    /* API For Delete Food Item */

    public function deleteFoddItemData($id) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $connection->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return Response::jsonResponse(true, "Food Item Deleted Successfully");

                    } else {
                    
                        return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
                    }
                } else {
                    
                    return Response::jsonResponse(false, "Food Item Not Found");
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

                    return Response::jsonResponse(true, "Food Item Get Successfully", $data);

                } else {
                    
                    return Response::jsonResponse(false, "Food Item Not Found");
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