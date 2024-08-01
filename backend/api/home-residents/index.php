<?php

require_once './home-residents.php';
require_once './home-residents-model.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }

    $details = new HomeResidents();

    $resultResponse = $details->list();

    return $resultResponse;

}  

if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }

    $id = validate_input($_GET['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');

    if (isset($id)) {

        $details = new HomeResidents();

        $hrd = $details->singleData($id);

        return $hrd;

    } else {
        
        return Response::jsonResponse(false, "Please provide valid Home Residents Id");
    
    }

}   

if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }
    
    $homeResidentsData = prepareHomeResidentsData($_POST);

    if (isset($homeResidentsData)) {
        
        $details = new HomeResidents();

        $hrd = $details->storeResidentsData($homeResidentsData);

        return $hrd;

    } else {
        
        return Response::jsonResponse(false, "Please provide Name, Food Type & Terminilogy");
    
    }

}   

if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }
    
    $homeResidentsData = prepareHomeResidentsData($_POST);

    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');

    if (isset($homeResidentsData)) {
          
        $details = new HomeResidents();

        $hrd = $details->updateResidentsData($homeResidentsData, $id);

        return $hrd;

    } else {
        
        return Response::jsonResponse(false, "Please provide Name, Food Type & Terminilogy");
    
    }

}   

if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");

    }
    
    $id = validate_input($_POST['id'], '/^[0-9]+$/' , 'Home Residents Id can only contain Numbers');

    if (isset($id)) {

        $login = new HomeResidents();

        $userData = $login->deleteResidentsData($id);

        return $userData;

    } else {
        
        return Response::jsonResponse(false, "Please provide Home Residents Id");
    
    }
}    

return Response::jsonResponse(false, "API Not Found");

?>
