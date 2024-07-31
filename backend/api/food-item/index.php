<?php

require_once './food-item.php';
require_once "./../response.php";
require_once "./../validate_input.php";


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new FoodItems();

        if(isset($_GET['search']) && $_GET['search'] != ""){

            $search = $_GET['search'];

            $loginResponse = $login->list($search);

        }else{
            
            $loginResponse = $login->list();
        }

        return $loginResponse;

    } else {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $id = $_GET['food_item_id'];

        if (isset($id)) {

            $login = new FoodItems();

            $userData = $login->singleData($id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false,"Please provide Food item Id");
        
        }

    } else {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $food_name = $_POST['food_name'];

        $food_category_id = $_POST['food_category_id'];
        
        $food_type_id = $_POST['food_type_id'];
        
        $food_terminology_id = $_POST['food_terminology_id'];

        if (isset($food_name) && isset($food_category_id) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('food_name'=>$food_name,'food_category_id'=>$food_category_id,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new FoodItems();

            $userData = $login->storeFoddItemData($array);

            return $userData;

        } else {
            
            return Response::jsonResponse(false,"Please provide Name, Category, Food Type & Terminilogy");
        
        }

    } else {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $food_name = $_POST['food_name'];
        $food_category_id = $_POST['food_category_id'];
        $food_type_id = $_POST['food_type_id'];
        $food_terminology_id = $_POST['food_terminology_id'];
        $id = $_POST['id'];

        if (isset($food_name) && isset($food_category_id) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('food_name'=>$food_name,'food_category_id'=>$food_category_id,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new FoodItems();

            $userData = $login->updateFoddItemData($array, $id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false,"Please provide Name, Category, Food Type & Terminilogy");
        
        }

    } else {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $id = $_POST['id'];

        if (isset($id)) {

            $login = new FoodItems();

            $userData = $login->deleteFoddItemData($id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false,"Please provide Food item Id");
        
        }

    } else {
        
        return Response::jsonResponse(false,"Request Method Not Allowed");
    }

}   else {
    
   return Response::jsonResponse(false,"API Not Found");

}

?>
