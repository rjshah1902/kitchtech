<?php

require_once 'constant/database.php';

$database = new Database();

$conn = $database->getConnection();

if ($conn) {
    echo "Database connection established successfully.";
} else {
    echo "Database connection failed.";
}
?>
