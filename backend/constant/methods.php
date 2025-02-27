<?php

require_once "database.php";

class CrudOperation extends Database {
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

        $result = $this->conn->prepare($qry);

        $result->execute();

        if ($dataType == 'row') {
            
            /* Get Single Row Data From The Database */
            $data = $result->fetch(PDO::FETCH_ASSOC);

        } else {

            /* Get All Result Data From The Database */
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

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

        try{

            $result = $this->conn->prepare($qry);

            $result->execute();

        } catch (PDOException $e) {
            
           echo $e->getMessage();

           return false;
        
        }

        $lastInsertId = $this->conn->lastInsertId();
        /* Get Insert ID from this */

        return $lastInsertId;
    }

    

    /* Update Data into the Database */

    public function updateData($table, $requestData, $where, $printQry = false) {
        
        $colomns = "";

        $totalCount = count($requestData);
        
        $params = [];

        $count = 0;
        
        /* Foreach Loop For the assign value in $keys & $values */
        foreach ($requestData as $key => $data) {
            
            $count++;
            
            $columns .= "`" . trim($key) . "` = ?";
            
            $params[] = trim($data);

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

        try{

            $result = $this->conn->prepare($qry);

            $result->execute($params);

        } catch (PDOException $e) {
            
           echo $e->getMessage();

           return false;
        
        }

        /* Check Return Reponse in case of Update Query */
        $returnReponse = $result->rowCount();

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

        try{

            $result = $this->conn->prepare($qry);

            $result->execute($params);

        } catch (PDOException $e) {
            
           echo $e->getMessage();

           return false;
        }

        /* Check Return Reponse in case of Update Query */
        $returnReponse = $result->rowCount();

        return $returnReponse;
    }
    
}

?>