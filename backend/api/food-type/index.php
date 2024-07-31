<?php

require_once './food-type.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new FoodType();
            
        $loginResponse = $login->list();

        return $loginResponse;

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else {
    
   return Response::jsonResponse(false, "API Not Found");

}

?>
