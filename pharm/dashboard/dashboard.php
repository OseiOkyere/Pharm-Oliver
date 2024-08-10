<?php
    include("../connection/db_connection.php");

    // Initialize variables to store data
    $sales_count = $products_count = $employees_count = 0;
    $sales_data = [];
    $top_selling_products = [];
    $inventory_levels = [];

    try {
        // Check if connection was successful
        if (!$conn) {
            throw new Exception("Database connection failed: " . mysqli_connect_error());
        }

        // Get sales count
        $salesResult = $conn->query("SELECT COUNT(*) AS sales_count FROM sales");
        if ($salesResult) {
            $sales_count = $salesResult->fetch_assoc()['sales_count'];
        } else {
            throw new Exception("Error fetching sales count: " . $conn->error);
        }

        // Get products count
        $productsResult = $conn->query("SELECT COUNT(*) AS products_count FROM products");
        if ($productsResult) {
            $products_count = $productsResult->fetch_assoc()['products_count'];
        } else {
            throw new Exception("Error fetching products count: " . $conn->error);
        }

        // Get employees count
        $employeesResult = $conn->query("SELECT COUNT(*) AS employees_count FROM employees");
        if ($employeesResult) {
            $employees_count = $employeesResult->fetch_assoc()['employees_count'];
        } else {
            throw new Exception("Error fetching employees count: " . $conn->error);
        }

        // Get sales data for chart
        $salesChartResult = $conn->query("SELECT MONTHNAME(sale_date) AS month, SUM(total_amount) AS total_sales FROM sales GROUP BY MONTH(sale_date)");
        if ($salesChartResult) {
            while ($row = $salesChartResult->fetch_assoc()) {
                $sales_data[] = $row;
            }
        } else {
            throw new Exception("Error fetching sales data: " . $conn->error);
        }

        // Get top selling products
        $topSellingProductsResult = $conn->query("SELECT p.name, SUM(s.total_amount) AS total_sales FROM sales s JOIN products p ON s.id = p.id GROUP BY p.id ORDER BY total_sales DESC LIMIT 5");
        if ($topSellingProductsResult) {
            while ($row = $topSellingProductsResult->fetch_assoc()) {
                $top_selling_products[] = $row;
            }
        } else {
            throw new Exception("Error fetching top selling products: " . $conn->error);
        }

        // Get inventory levels
        $inventoryLevelsResult = $conn->query("SELECT name, quantity FROM products");
        if ($inventoryLevelsResult) {
            while ($row = $inventoryLevelsResult->fetch_assoc()) {
                $inventory_levels[] = $row;
            }
        } else {
            throw new Exception("Error fetching inventory levels: " . $conn->error);
        }

        // Close the connection
        $conn->close();

    } catch (Exception $e) {
        echo "<p class='text-red-500'>Error: " . $e->getMessage() . "</p>";
    }
    ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome (optional, for icons) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>

<body class="bg-gray-100 p-8">

    <main>
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
        
        <!-- Box Info Section -->
        <ul class="grid grid-cols-3 gap-4 mb-8">
            <li id="sales-box" class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-cash-register text-3xl text-blue-500 mr-4"></i>
                <span class="text">
                    <a id="sales-count" class="text-2xl font-bold"><?= $sales_count ?></a>
                    <p class="text-gray-600">Sales</p>
                </span>
            </li>
            <li id="products-box" class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-boxes text-3xl text-green-500 mr-4"></i>
                <span class="text">
                    <a id="products-count" class="text-2xl font-bold"><?= $products_count ?></a>
                    <p class="text-gray-600">Products</p>
                </span>
            </li>
            <li id="employees-box" class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-users text-3xl text-purple-500 mr-4"></i>
                <span class="text">
                    <a id="employees-count" class="text-2xl font-bold"><?= $employees_count ?></a>
                    <p class="text-gray-600">Employees</p>
                </span>
            </li>
        </ul>

        <!-- Sales Overview Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Sales Overview</h1>
                <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-400">
                    <i class="fas fa-cloud-download-alt"></i>
                </button>
            </div>
            <canvas id="salesChart"></canvas>
        
        </div>

        <!-- Top Selling Products Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h1 class="text-xl font-bold mb-4">Top Selling Products</h1>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Product</th>
                        <th class="border px-4 py-2">Total Sales</th>
                    </tr>
                </thead>
                <tbody id="top-products-body">
                    <?php foreach ($top_selling_products as $product): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $product['name'] ?></td>
                            <td class="border px-4 py-2"><?= $product['total_sales'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        
        <!-- Inventory Levels Section -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-xl font-bold mb-4">Inventory Levels</h1>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Product</th>
                        <th class="border px-4 py-2">Quantity</th>
                    </tr>
                </thead>
                <tbody id="inventory-levels-body">
                    <?php foreach ($inventory_levels as $inventory): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $inventory['name'] ?></td>
                            <td class="border px-4 py-2"><?= $inventory['quantity'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>
