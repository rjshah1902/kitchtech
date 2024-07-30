<?php

require_once "./../index.php";
require_once "./../response.php";

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
                
                return Response::jsonResponse(true, "Food Item List Fetchead Successfully", $data);

            } else {
            
                return Response::jsonResponse(true, "Data is Empty");
            }

        }else{

            return Response::jsonResponse(false,'Failed to connect to the database');
        
        }
    }
    

    /* API For Add Food Item */

    public function storeFoddItemData($requestdata) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            $update = $curdOperation->insertData($this->tableName, $requestdata);

            if($update){
                
                return Response::jsonResponse(true, "Food Item Added Successfully", $requestdata);

            } else {
            
                return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
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
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$id > 0){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $delete = $curdOperation->deleteData($this->tableName, $where);

                    if($delete){
                        
                        return Response::jsonResponse(true, "Food Item Deleted Successfully", $resultData);

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
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if($id != ""){

                $where = "id = '" . $id ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

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