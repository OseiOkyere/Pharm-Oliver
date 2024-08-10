<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "pharma_db";

try {
    // Create a new PDO instance
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit();
}
?>