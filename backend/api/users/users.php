<?php

require_once "./../index.php";

class Users extends BaseController {

    private $tableName = "users";

    public function __construct() {
        parent::__construct();
    }

    public function loginUser($username, $password) {

        $connection = $this->getDatabase();
    
        if ($connection !== null) {
            
            $where = "username = '" . $username ."'";
            
            $data = $connection->getData("*", $this->tableName, "row", $where);
    
            if($data){
                
                $hashedPassword = $data['password'];
    
                if (password_verify($password, $hashedPassword)) {
        
                    $columns = "id, name, username, email, contact";
                    $userDetails = $connection->getData($columns, $this->tableName, "row", $where);
    
                    return Response::jsonResponse(true, "User Login Successfully", $userDetails);
        
                } else {
        
                    return Response::jsonResponse(false, "Please Provide a Valid Password", []);
        
                }
        
            } else {
        
                return Response::jsonResponse(false, "User Not Exist", []);
        
            }
        
        } else {

            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed", []);
        
        }
    }
    
    

    public function getUserData($userId) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if($userId > 0){

                $where = "id = '" . $userId ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){
                    
                    return Response::jsonResponse(true, "User Login Successfully", $data);

                } else {
                
                    return Response::jsonResponse(false, "User Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid User Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }
    

    public function updateUserData($requestdata, $userId) {
        
        $connection = $this->getDatabase();

        if ($connection !== null) {
            
            if((int)$userId > 0){

                $where = "id = '" . $userId ."'";
                
                $data = $connection->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $connection->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $connection->getData("*", $this->tableName, "row", $where);
                        
                        return Response::jsonResponse(true, "User Updated Successfully",$resultData);

                    } else {
                    
                        return Response::jsonResponse(false, "Something Went Wrong, Please try again after some time");
                    }
                } else {
                    
                    return Response::jsonResponse(false, "User Not Found");
                }

            } else {
                
                return Response::jsonResponse(false, "Please Provide a Valid User Id");
            }

        } else {
            
            return Response::jsonResponse(false, "Cannot perform database operations because the connection failed");
        
        }
    }
}

?>