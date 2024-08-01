<?php

require_once './food-item.php';
require_once './food-item-model.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    
    }

    $login = new FoodItems();

    if(isset($_GET['search']) && $_GET['search'] != ""){

        $search = $_GET['search'];

        $loginResponse = $login->list($search);

    }else{
        
        $loginResponse = $login->list();
    }

    return $loginResponse;
}  


if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

    $id = validate_input($_GET['food_item_id'], '/^[0-9]+$/' , 'Food Item Id can only contain Numbers');

    if (!isset($id)) {
        
        return Response::jsonResponse(false,"Please provide Food item Id");
    
    }

    $login = new FoodItems();

    $userData = $login->singleData($id);

    return $userData;

}   

if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }
        
    $foodItem = prepareFoodItemData($_POST);

    if (isset($foodItem['food_name']) && isset($foodItem['food_category_id']) && isset($foodItem['food_type_id']) && isset($foodItem['food_terminology_id'])) {

        $check = new FoodItems();

        $returnData = $check->storeFoddItemData($foodItem);

        return $returnData;

    } else {
        
        return Response::jsonResponse(false,"Please provide Name, Category, Food Type & Terminilogy");
    
    }

}   


if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }
    
    $foodItem = prepareFoodItemData($_POST);

    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Food Item Id can only contain Numbers');

    if (isset($foodItem)) {

        $login = new FoodItems();

        $userData = $login->updateFoddItemData($foodItem, $id);

        return $userData;

    } else {
        
        return Response::jsonResponse(false,"Please provide Name, Category, Food Type & Terminilogy");
    
    }

}   


if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }
    
    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Food Item Id can only contain Numbers');

    if (!isset($id)) {
        
        return Response::jsonResponse(false,"Please provide Food item Id");

    }

    $login = new FoodItems();

    $userData = $login->deleteFoddItemData($id);

    return $userData;

}   
    
return Response::jsonResponse(false,"API Not Found");


?>
