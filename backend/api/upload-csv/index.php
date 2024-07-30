<?php

require_once './upload-csv.php';
require_once "./../response.php";

if ($_GET['name'] == 'upload-csv') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $csvUploader = new UploadCSV();
        
        echo $csvUploader->upload();

    } else {
        
        echo Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else {
    
   echo Response::jsonResponse(false, "API Not Found");

}

?>
