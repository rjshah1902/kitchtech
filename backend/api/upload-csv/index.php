<?php

require_once './upload-csv.php';

if ($_GET['name'] == 'upload-csv') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $csvUploader = new UploadCSV();
        
        return $csvUploader->upload();

    } else {
        
        return Response::jsonResponse(false, "Request Method Not Allowed");
    }

} else {
    
   return Response::jsonResponse(false, "API Not Found");

}

?>
