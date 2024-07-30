<?php

require_once "./../index.php";

class Users extends BaseController {

    private $tableName = "users";

    public function __construct() {
        parent::__construct();
    }

    public function loginUser($username, $password) {
        $curdOperation = $this->getDatabase();
    
        if ($curdOperation !== null) {
            
            $where = "username = '" . $username ."'";
            
            $data = $curdOperation->getData("*", $this->tableName, "row", $where);
    
            if($data){
                
                $hashedPassword = $data['password'];
    
                if (password_verify($password, $hashedPassword)) {
        
                    $columns = "id, name, username, email, contact";
                    $userDetails = $curdOperation->getData($columns, $this->tableName, "row", $where);
    
                    return json_encode(array("status" => true, "message" => "User Login Successfully", "data" => $userDetails));
        
                } else {
        
                    return json_encode(array("status" => false, "message" => "Please Provide a Valid Password", "data" => []));
        
                }
        
            } else {
        
                return json_encode(array("status" => false, "message" => "User Not Exist", "data" => []));
        
            }
        
        } else {

            return json_encode(array("status" => false, "message" => "Cannot perform database operations because the connection failed", "data" => []));
        
        }
    }
    
    

    public function getUserData($userId) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if($userId > 0){

                $where = "id = '" . $userId ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){
                    
                    return json_encode(array("status"=>true, "message"=>"User Login Successfully", "data"=>$data));

                } else {
                
                    return json_encode(array("status"=>false, "message"=>"User Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid User Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }
    

    public function updateUserData($requestdata, $userId) {
        
        $curdOperation = $this->getDatabase();

        if ($curdOperation !== null) {
            
            if((int)$userId > 0){

                $where = "id = '" . $userId ."'";
                
                $data = $curdOperation->getData("*", $this->tableName, "row", $where);

                if($data){

                    $update = $curdOperation->updateData($this->tableName, $requestdata, $where);

                    if($update){
                    
                        $resultData = $curdOperation->getData("*", $this->tableName, "row", $where);
                        
                        return json_encode(array("status"=>true, "message"=>"User Updated Successfully", "data"=>$resultData));

                    } else {
                    
                        return json_encode(array("status"=>false, "message"=>"Something Went Wrong, Please try again after some time", "data"=>[]));
                    }
                } else {
                    
                    return json_encode(array("status"=>false, "message"=>"User Not Found", "data"=>[]));
                }

            } else {
                
                return json_encode(array("status"=>false, "message"=>"Please Provide a Valid User Id", "data"=>[]));
            }

        } else {
            
            return json_encode(array("status"=>false, "message"=>"Cannot perform database operations because the connection failed", "data"=>[]));
        
        }
    }
}

?>