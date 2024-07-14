<?php

require_once "database.php";

class CurdOperation extends Database {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /* Get All The From Database */

    public function getData($select = "*", $table, $dataType = "row", $where = null, $order = null, $join = null, $other = "") {
        
        $qry = "SELECT $select FROM $table ";

        if ($join) { $qry .= $join . " "; }

        if ($where) { $qry .= "WHERE $where "; }

        if ($order) {  $qry .= "ORDER BY $order "; }

        $qry .= $other;

        $result = mysqli_query($this->conn, $qry);

        if (!$result) {
            echo "Error in query: " . mysqli_error($this->conn);
            return null;
        }

        if ($dataType == 'row') {
            
            /* Get Single Row Data From The Database */
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        } else {

            /* Get All Result Data From The Database */
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        }

        return $data;
    }

    
    /* Insert Data into the Database */

    public function insertData($table, $requestData, $printQry = false) {
        
        $colomns = $values = "";

        /* Count the number of rows in the array */
        $totalCount = count($requestData);

        $count = 0;

        /* Foreach Loop For the assign value in $keys & $values */
        foreach ($requestData as $key => $data) {
            
            $count++;
            
            $columns .= trim($key);
            
            $values .= "'" . trim($data) . "'";

            if ($count < $totalCount) {
                $columns .= ", "; $values .= ", ";
            }
        }

        /* Insert Query For the All Tables */
        $qry = "INSERT INTO `$table` ($columns) VALUES ($values)";

        /* Return Query as a response */
        if ($printQry === true) {
            echo $qry;
        }

        $result = mysqli_query($this->conn, $qry);

        /* In case of any Error return the error here */
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn);
        }

        /* Get Insert ID from this */
        $lastInsertId = mysqli_insert_id($this->conn);

        return $lastInsertId;
    }

    

    /* Update Data into the Database */

    public function updateData($table, $requestData, $where, $printQry = false) {
        
        $colomns = "";

        $totalCount = count($requestData);

        $count = 0;
        
        /* Foreach Loop For the assign value in $keys & $values */
        foreach ($requestData as $key => $data) {
            
            $count++;
            
            $columns .= trim($key) ." = '" . trim($data) . "'";

            if ($count < $totalCount) {
                $columns .= ", ";
            }
        }

        /* Update Query For the Data */
        $qry = "UPDATE `$table` SET $columns WHERE $where";

        if(!$where){
            echo "Please provide a WHERE condition";
            return false;
        }

        /* Return Query as a response */
        if ($printQry === true) {
            echo $qry;
        }

        $result = mysqli_query($this->conn, $qry);

        /* In case of any Error return the error here */
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn);
        }

        /* Check Return Reponse in case of Update Query */
        $returnReponse = mysqli_affected_rows($this->conn);

        return $returnReponse;
    }

    

    /* Update Data into the Database */

    public function deleteData($table, $where, $printQry = false) {
        
        /* Delete Query For the Data */
        $qry = "DELETE FROM `$table` WHERE $where";

        if(!$where){
            echo "Please provide a WHERE condition";
            return false;
        }

        /* Return Query as a response */
        if ($printQry === true) {
            echo $qry;
        }

        $result = mysqli_query($this->conn, $qry);

        /* In case of any Error return the error here */
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn);
        }

        /* Check Return Reponse in case of Delete Query */
        $returnReponse = mysqli_affected_rows($this->conn);

        return $returnReponse;
    }
    
}

?>