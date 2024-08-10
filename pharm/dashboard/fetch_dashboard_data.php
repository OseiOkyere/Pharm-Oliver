<?php
include("../connection/db_connection.php");


header('Content-Type: application/json');


    // Initialize an array to hold the results
    $data = [];

    // Get sales count
    $salesResult = $conn->query("SELECT COUNT(*) AS sales_count FROM sales");
    if ($salesResult) {
        $data['sales_count'] = $salesResult->fetch_assoc()['sales_count'];
    }

    // Get products count
    $productsResult = $conn->query("SELECT COUNT(*) AS products_count FROM products");
    if ($productsResult) {
        $data['products_count'] = $productsResult->fetch_assoc()['products_count'];
    }

    // Get purchases count
    $purchasesResult = $conn->query("SELECT COUNT(*) AS purchases_count FROM purchases");
    if ($purchasesResult) {
        $data['purchases_count'] = $purchasesResult->fetch_assoc()['purchases_count'];
    }

    // Get sales data for chart
    $salesData = [];
    $salesChartResult = $conn->query("SELECT MONTHNAME(purchase_date) AS month, SUM(amount) AS total_sales FROM purchases GROUP BY MONTH(purchase_date)");
    if ($salesChartResult) {
        while ($row = $salesChartResult->fetch_assoc()) {
            $salesData[] = $row;
        }
    }
    $data['sales_data'] = $salesData;

    // Get recent purchases
    $recentPurchases = [];
    $recentPurchasesResult = $conn->query("SELECT product_name, quantity, amount, purchase_date, customer_name FROM purchases ORDER BY purchase_date DESC LIMIT 5");
    if ($recentPurchasesResult) {
        while ($row = $recentPurchasesResult->fetch_assoc()) {
            $recentPurchases[] = $row;
        }
    }
    $data['recent_purchases'] = $recentPurchases;

    // Close the connection
    $conn->close();

    // Output the JSON data
    echo json_encode($data);

} catch (Exception $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
