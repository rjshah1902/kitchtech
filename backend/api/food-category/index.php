<?php

require_once './food-category.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {

        return Response::jsonResponse(false, "Request Method Not Allowed");

    }

    $login = new FoodCategory();

    $loginResponse = $login->list();

    return $loginResponse;
    
}

return Response::jsonResponse(false, "API Not Found");


?>
