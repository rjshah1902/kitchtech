<?php

require_once "./../index.php";

class UploadCSV extends BaseController {

    private $tableName = "home_residents";
    private $tableName2 = "food_terminology";

    public function __construct() {
        parent::__construct();
    }

    /* API for uploading and processing CSV */

    public function upload() {

        if (!isset($_FILES['csv']) || $_FILES['csv']['error'] !== UPLOAD_ERR_OK) {
        
            return Response::jsonResponse(false, 'There is no file uploaded or there was an error uploading the file.');
        
        }
        
        $fileTmpPath = $_FILES['csv']['tmp_name'];
        $fileName = $_FILES['csv']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        if ($fileExtension !== 'csv') {
        
            return Response::jsonResponse(false, 'Upload failed. Allowed file types: CSV.');
        
        }
        
        $uploadFileDir = './../../uploads/';
        $dest_path = $uploadFileDir . $fileName;
        
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
      
            return Response::jsonResponse(false, 'There was an error moving the uploaded file.');
      
        }
        
        $connection = $this->getDatabase();
        
        if ($connection === null) {
      
            return Response::jsonResponse(false, 'Failed to connect to the database');
      
        }
        
        $csvData = [];
        
        if (($handle = fopen($dest_path, "r")) !== FALSE) {
        
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
                $csvData[] = $data;
            }
        
            fclose($handle);
        
        }
        
        foreach ($csvData as $data) {
            $where = "terminology_name LIKE '%" . $data[1] . "%'";
            $check = $connection->getData("*", $this->tableName2, "row", $where);
        
            if (!empty($check)) {
                $connection->insertData($this->tableName, [
                    'name' => $data[0],
                    'food_type_id' => $check['food_type_id'],
                    'food_terminology_id' => $check['id'],
                ]);
            }
        }
        
        return Response::jsonResponse(true, "File is successfully uploaded and processed.");
        
    }
}

?>
