<?php
// Include database connection
include("../connection/db_connection.php");

// Get POST data
$id = $_POST['id'] ?? '';

// Validate input
if (empty($id)) {
    echo json_encode(['status' => 'error', 'message' => 'Product ID is required']);
    exit;
}

// Prepare and execute delete query
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

// Check result
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete product']);
}

// Close connection
$conn->close();
?>
