<?php

require_once './food-category.php';


if ($_GET['name'] === 'list') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $login = new FoodCategory();

        $loginResponse = $login->list();

        echo $loginResponse;

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

}  else {
    
   echo json_encode(array("status"=>false, "message"=>"API Not Found", "data"=>[]));

}

?>
