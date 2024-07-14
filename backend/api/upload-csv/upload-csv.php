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

        if (isset($_FILES['csv']) && $_FILES['csv']['error'] === UPLOAD_ERR_OK) {

            $fileTmpPath = $_FILES['csv']['tmp_name'];
            $fileName = $_FILES['csv']['name'];
            $fileSize = $_FILES['csv']['size'];
            $fileType = $_FILES['csv']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            if ($fileExtension === 'csv') {

                $uploadFileDir = './../../uploads/';

                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $connection = $this->getDatabase();

                    if ($connection !== null) {
                        
                        if (($handle = fopen($dest_path, "r")) !== FALSE) {
                            $row = 0;
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                $row++;

                                $where = "terminology_name LIKE '%".$data[1]."%'";

                                $check = $connection->getData("*",$this->tableName2,"row", $where);
                                
                                if(!empty($check)){
                                    
                                    $connection->insertData($this->tableName, [
                                        'name' => $data[0],
                                        'food_type_id' => $check['food_type_id'],
                                        'food_terminology_id' => $check['id'],
                                    ]);

                                } else {
                                    continue;
                                }
                            }
                            fclose($handle);
                        }

                        return json_encode(array("status" => true, "message" => "File is successfully uploaded and processed."));
                    } else {
                        return json_encode(array('status' => false, 'message' => 'Failed to connect to the database'));
                    }
                } else {
                    return json_encode(array('status' => false, 'message' => 'There was an error moving the uploaded file.'));
                }
            } else {
                return json_encode(array('status' => false, 'message' => 'Upload failed. Allowed file types: CSV.'));
            }
        } else {
            return json_encode(array('status' => false, 'message' => 'There is no file uploaded or there was an error uploading the file.'));
        }
    }
}

?>
