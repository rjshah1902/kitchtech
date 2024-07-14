<?php

require_once './upload-csv.php';

if ($_GET['name'] == 'upload-csv') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $csvUploader = new UploadCSV();
        
        echo $csvUploader->upload();

    } else {
        
        echo json_encode(array("status"=>false, "message"=>"Request Method Not Allowed", "data"=>[]));
    }

} else {
    
   echo json_encode(array("status"=>false, "message"=>"API Not Found", "data"=>[]));

}

?>
