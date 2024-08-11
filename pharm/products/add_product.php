<?php
// Include database connection
include("../connection/db_connection.php");

// Get POST data
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$category_id = $_POST['category_id'] ?? '';
$supplier_id = $_POST['supplier_id'] ?? '';

// Validate input
if (empty($name) || empty($price) || empty($quantity) || empty($category_id) || empty($supplier_id)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Prepare and execute insert query
$sql = "INSERT INTO products (name, description, price, quantity, category_id, supplier_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$name, $description, $price, $quantity, $category_id, $supplier_id]);

// Check result
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Product added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add product']);
}

// Close connection
$conn->close();
?>
