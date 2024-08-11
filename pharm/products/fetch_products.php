<?php

include("../connection/db_connection.php");

$sql = "SELECT products.id, products.name, products.description, products.price, products.quantity, 
        categories.name as category, suppliers.name as supplier 
        FROM products 
        LEFT JOIN categories ON products.category_id = categories.id 
        LEFT JOIN suppliers ON products.supplier_id = suppliers.id";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();
?>
