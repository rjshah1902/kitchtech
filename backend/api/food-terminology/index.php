<?php

require_once './food-terminology.php';
require_once "./../response.php";


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
    
        $id = $_GET['food_terminology_id'];

        if (isset($id)) {

            $login = new FoodTerminology();

            $userData = $login->singleData($id);

            echo $userData;

        } else {
            
            echo Response::jsonResponse(false, "Please provide Food item Id");
        
        }

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $terminology_name = $_POST['terminology_name'];
        $food_type_id = $_POST['food_type_id'];
        $terminology_number = $_POST['terminology_number'];

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
    
        $terminology_name = $_POST['terminology_name'];
        $food_type_id = $_POST['food_type_id'];
        $terminology_number = $_POST['terminology_number'];
        $id = $_POST['id'];

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
    
        $id = $_POST['id'];

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
