<?php

require_once './food-item.php';


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
        
        $food_name = validate_input($_POST['food_name'], '/^[a-zA-Z\s]+$/' , 'Food Name can only contain letters and spaces');  
        
        $food_category_id = validate_input($_POST['food_category_id'], '/^[0-9]+$/' , 'Food Category can only contain Numbers');   
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $food_terminology_id = validate_input($_POST['food_terminology_id'], '/^[0-9]+$/' , 'Food Category can only contain Numbers'); 
        

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
    
        $food_name = validate_input($_POST['food_name'], '/^[a-zA-Z\s]+$/' , 'Food Name can only contain letters and spaces');  
        
        $food_category_id = validate_input($_POST['food_category_id'], '/^[0-9]+$/' , 'Food Category can only contain Numbers');   
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $food_terminology_id = validate_input($_POST['food_terminology_id'], '/^[0-9]+$/' , 'Food Category can only contain Numbers'); 

        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Food Item Id can only contain Numbers');

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
    
        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Food Item Id can only contain Numbers');

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
