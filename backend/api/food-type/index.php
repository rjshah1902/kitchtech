<?php

require_once './food-type.php';
require_once "./../response.php";


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new FoodType();
            
        $loginResponse = $login->list();

        echo $loginResponse;

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else {
    
   echo Response::jsonResponse(false, "API Not Found");

}

?>
