// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "pharmacy_db";

try {
    // Create a new PDO instance
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
