<?php

require_once './food-terminology.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new FoodTerminology();

        $loginResponse = $login->list();

        echo $loginResponse;

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $id = validate_input($_GET['food_terminology_id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

        if (isset($id)) {

            $login = new FoodTerminology();

            $userData = $login->singleData($id);

            echo $userData;

        } else {
            
            echo Response::jsonResponse(false, "Please provide Valid Food Terminology Id");
        
        }

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $terminology_name = validate_input($_POST['terminology_name'], '/^[a-zA-Z\s]+$/' , 'Terminology Name can only contain letters and spaces');  
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $terminology_number = validate_input($_POST['terminology_number'], '/^[0-9]+$/' , 'Terminology Number can only contain Numbers'); 

        if (isset($terminology_name)  && isset($food_type_id) && isset($terminology_number)) {

            $array = array('terminology_name'=>$terminology_name, 'food_type_id'=>$food_type_id,'terminology_number'=>$terminology_number);

            $login = new FoodTerminology();

            $userData = $login->storeFoodTerminologyData($array);

            echo $userData;

        } else {
            
            echo Response::jsonResponse(false, "Please provide Name, Category, Food Type & Terminilogy Number");
        
        }

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $terminology_name = validate_input($_POST['terminology_name'], '/^[a-zA-Z\s]+$/' , 'Terminology Name can only contain letters and spaces');  
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $terminology_number = validate_input($_POST['terminology_number'], '/^[0-9]+$/' , 'Terminology Number can only contain Numbers'); 
        
        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

        if (isset($terminology_name)  && isset($food_type_id) && isset($terminology_number)) {

            $array = array('terminology_name'=>$terminology_name, 'food_type_id'=>$food_type_id,'terminology_number'=>$terminology_number);

            $login = new FoodTerminology();

            $userData = $login->updateFoodTerminologyData($array, $id);

            echo $userData;

        } else {
            
            echo Response::jsonResponse(false, "Please provide Name, Category, Food Type & Terminilogy Number");
        
        }

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Terminology Id can only contain Numbers'); 

        if (isset($id)) {

            $login = new FoodTerminology();

            $userData = $login->deleteFoodTerminologyData($id);

            echo $userData;

        } else {
            
            echo Response::jsonResponse(false, "Please provide Food Terminology Id");
        
        }

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

}   else {
    
   echo Response::jsonResponse(false, "API Not Found");

}

?>
