<?php

require_once './home-residents.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new HomeResidents();

        $loginResponse = $login->list();

        echo $loginResponse;

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

} else if ($_GET['name'] == 'details') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $id = $_GET['id'];

        if (isset($id)) {

            $login = new HomeResidents();

            $userData = $login->singleData($id);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide Food item Id", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else if ($_GET['name'] == 'store') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $name = $_POST['name'];
        $food_type_id = $_POST['food_type_id'];
        $food_terminology_id = $_POST['food_terminology_id'];

        if (isset($name) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('name'=>$name,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new HomeResidents();

            $userData = $login->storeResidentsData($array);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide Name, Food Type & Terminilogy", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else if ($_GET['name'] == 'update') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $name = $_POST['name'];
        $food_type_id = $_POST['food_type_id'];
        $food_terminology_id = $_POST['food_terminology_id'];
        $id = $_POST['id'];

        if (isset($name) && isset($food_type_id) && isset($food_terminology_id)) {

            $array = array('name'=>$name,'food_type_id'=>$food_type_id,'food_terminology_id'=>$food_terminology_id);

            $login = new HomeResidents();

            $userData = $login->updateResidentsData($array, $id);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide Name, Food Type & Terminilogy", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else if ($_GET['name'] == 'delete') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $id = $_POST['id'];

        if (isset($id)) {

            $login = new HomeResidents();

            $userData = $login->deleteResidentsData($id);

            echo $userData;

        } else {
            
            echo json_encode(array("status"=>false, "message"=>"Please provide Home Residents Id", "data"=>[]));
        
        }

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}   else {
    
   echo json_encode(array("status"=>false, "message"=>"API Not Found", "data"=>[]));

}

?>
