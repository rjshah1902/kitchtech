<?php

require_once './users.php';


if ($_GET['name'] === 'login') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $username = validate_input($_POST['username'], '/^[a-zA-Z0-9\s]+$/' , 'Name can only contain letters and spaces');  
        
        $password = $_POST['password'];

        if (isset($username) && isset($password)) {

            $login = new Users();

            $loginResponse = $login->loginUser($username, $password);

            return $loginResponse;

        } else {
            
            return Response::jsonResponse(false, "Please provide Username & Password");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else if ($_GET['name'] == 'user-data') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $userId = $_GET['userId'];

        if (isset($userId)) {

            $login = new Users();

            $userData = $login->getUserData($userId);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide User Id");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'update-user') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $userId = $_POST['userId'];

        if (isset($userId)) {

            $requestdata = array();

            $name = validate_input($_POST['name'], '/^[a-zA-Z\s]+$/' , 'Name can only contain letters and spaces');
            if(isset($name)){
                $requestdata += array('name' => $name);
            }

            $username = validate_input($_POST['username'], '/^[a-zA-Z0-9@\s]+$/' , 'Username can only contain letters, numbers and @');
            if(isset($username)){
                $requestdata += array('username' => $username);
            }

            $email = $_POST['email'];
            if (isset($email) && !empty($email)) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return Response::jsonResponse(false, "Invalid Email format");
                }
                $requestdata['email'] = $email;
            }

            $contact = $_POST['contact'];
            if (isset($contact) && !empty($contact)) {
                if (!preg_match('/^[6-9]{1}[0-9]{9}$/', $contact)) {
                    return Response::jsonResponse(false, "Invalid Contact format");
                }
                $requestdata['contact'] = $contact;
            }

            $password = $_POST['password'];
            if (isset($password) && !empty($password)) {
                if (strlen($password) < 6) {
                    return Response::jsonResponse(false, "Password must be at least 6 characters");
                }
                $requestdata['password'] = password_hash($password,PASSWORD_DEFAULT);
            }

            $login = new Users();

            $userData = $login->updateUserData($requestdata, $userId);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide User Id");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else {
    
   return Response::jsonResponse(false, "API Not Found");

}

?>
