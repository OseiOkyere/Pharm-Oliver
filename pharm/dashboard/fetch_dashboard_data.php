<?php
include("../connection/db_connection.php");

header('Content-Type: application/json');

try {
    // Check if connection was successful
    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    // Initialize an array to hold the results
    $data = [];

    // Get sales data for chart
    $salesData = [];
    $salesChartResult = $conn->query("SELECT DATE(sale_date) AS date, SUM(total_amount) AS total_sales FROM sales GROUP BY DATE(sale_date)");
    if ($salesChartResult) {
        while ($row = $salesChartResult->fetch_assoc()) {
            $salesData[] = $row;
        }
        $data['sales_data'] = $salesData;
    } else {
        throw new Exception("Error fetching sales data: " . $conn->error);
    }

    // Close the connection
    $conn->close();

    // Output the JSON data
    echo json_encode($data);

} catch (Exception $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
