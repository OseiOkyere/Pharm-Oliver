<?php
// Include database connection
include("../connection/db_connection.php");

// Get POST data
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$category_id = $_POST['category_id'] ?? '';
$supplier_id = $_POST['supplier_id'] ?? '';

// Validate input
if (empty($id) || empty($name) || empty($price) || empty($quantity) || empty($category_id) || empty($supplier_id)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Prepare and execute update query
$sql = "UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, category_id = ?, supplier_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$name, $description, $price, $quantity, $category_id, $supplier_id, $id]);

// Check result
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Product updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update product']);
}

// Close connection
$conn->close();
?>
