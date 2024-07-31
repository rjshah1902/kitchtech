<?php

require_once './home-residents.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new HomeResidents();

        $loginResponse = $login->list();

        return $loginResponse;

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $id = validate_input($_GET['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');

        if (isset($id)) {

            $login = new HomeResidents();

            $userData = $login->singleData($id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide valid Home Residents Id");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $name = validate_input($_POST['name'], '/^[a-zA-Z\s]+$/' , 'Home Residents Name can only contain letters and spaces');  
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $food_terminology_id = validate_input($_POST['food_terminology_id'], '/^[0-9]+$/' , 'Food Terminology can only contain Numbers');  

        if (isset($name) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('name'=>$name,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new HomeResidents();

            $userData = $login->storeResidentsData($array);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide Name, Food Type & Terminilogy");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $name = validate_input($_POST['name'], '/^[a-zA-Z\s]+$/' , 'Home Residents can only contain letters and spaces');  
        
        $food_type_id = validate_input($_POST['food_type_id'], '/^[0-9]+$/' , 'Food Type can only contain Numbers');  
        
        $food_terminology_id = validate_input($_POST['food_terminology_id'], '/^[0-9]+$/' , 'Food Terminology can only contain Numbers');  
        
        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');  

        if (isset($name) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('name'=>$name,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new HomeResidents();

            $userData = $login->updateResidentsData($array, $id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide Name, Food Type & Terminilogy");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}  else if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');

        if (isset($id)) {

            $login = new HomeResidents();

            $userData = $login->deleteResidentsData($id);

            return $userData;

        } else {
            
            return Response::jsonResponse(false, "Please provide Home Residents Id");
        
        }

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

}   else {
    
   return Response::jsonResponse(false, "API Not Found");

}

?>
