<?php
// Include database connection
include("../connection/db_connection.php");

// Fetch products
$sql = "SELECT p.id, p.name, p.description, p.price, p.quantity, c.name AS category, s.name AS supplier, p.created_at 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        LEFT JOIN suppliers s ON p.supplier_id = s.id";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Fetch categories
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch suppliers
$sql = "SELECT id, name FROM suppliers";
$result = $conn->query($sql);

$suppliers = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }
}

// Combine the results
$response = [
    'products' => $products,
    'categories' => $categories,
    'suppliers' => $suppliers,
];

echo json_encode($response);

// Close the database connection
$conn->close();
?>
