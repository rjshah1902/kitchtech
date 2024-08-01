<?php

require_once './food-terminology.php';
require_once './terminology-mode.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }

    $login = new FoodTerminology();

    $loginResponse = $login->list();

    return $loginResponse;

}   

if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }
        
    $id = validate_input($_GET['food_terminology_id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

    if (isset($id)) {

        $login = new FoodTerminology();

        $userData = $login->singleData($id);

        return $userData;

    } else {
        
        return Response::jsonResponse(false, "Please provide Valid Food Terminology Id");
    
    }

}  

if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    
    }
    
    $terminologyData = prepareTerminologyData($_POST);

    if (isset($terminologyData)) {

        $login = new FoodTerminology();

        $userData = $login->storeFoodTerminologyData($terminologyData);

        return $userData;

    } else {
        
        return Response::jsonResponse(false, "Please provide Name, Category, Food Type & Terminilogy Number");
    
    }

}  


if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    
    }

    $terminologyData = prepareTerminologyData($_POST);
    
    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

    if (isset($terminologyData)) {

        $login = new FoodTerminology();

        $userData = $login->updateFoodTerminologyData($terminologyData, $id);

        return $userData;

    } else {
        
        return Response::jsonResponse(false, "Please provide Name, Category, Food Type & Terminilogy Number");
    
    }

}   

if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }

    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

    if (!isset($id)) {
        
        return Response::jsonResponse(false, "Please provide Food Terminology Id");

    }

    $login = new FoodTerminology();

    $userData = $login->deleteFoodTerminologyData($id);

    return $userData;

}
    

return Response::jsonResponse(false, "API Not Found");

?>
