<?php

require_once './users.php';


if ($_GET['name'] === 'login') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $username = $_POST['username'];  $password = $_POST['password'];

        if (isset($username) && isset($password)) {

            $login = new Users();

            $loginResponse = $login->loginUser($username, $password);

            echo $loginResponse;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide Username & Password", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

} else if ($_GET['name'] == 'user-data') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $userId = $_GET['userId'];

        if (isset($userId)) {

            $login = new Users();

            $userData = $login->getUserData($userId);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide User Id", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else if ($_GET['name'] == 'update-user') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $userId = $_POST['userId'];

        if (isset($userId)) {

            $requestdata = array();

            $name = $_POST['name'];
            if(isset($name)){
                $requestdata += array('name' => $name);
            }

            $username = $_POST['username'];
            if(isset($username)){
                $requestdata += array('username' => $username);
            }

            $email = $_POST['email'];
            if(isset($email)){
                $requestdata += array('email' => $email);
            }

            $contact = $_POST['contact'];
            if(isset($contact)){
                $requestdata += array('contact' => $contact);
            }

            $password = $_POST['password'];
            if(isset($password)){
                $requestdata += array('password' => $password);
            }

            $login = new Users();

            $userData = $login->updateUserData($requestdata, $userId);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide User Id", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else {
    
   echo json_encode(array("status"=>false, "message"=>"API Not Found", "data"=>[]));

}

?>
