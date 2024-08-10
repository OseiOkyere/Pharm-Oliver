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
</head>

<body class="bg-gray-100 p-8">

    <main>
        <h2>Dashboard</h2>
        <!-- Box Info Section -->
        <ul class="grid grid-cols-3 gap-4 mb-8">
            
            <li class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-cash-register text-3xl text-blue-500 mr-4"></i>
                <span class="text">
                    <a class="text-2xl font-bold">020</a>
                    <p class="text-gray-600">Sales</p>
                </span>
            </li>
            <li class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-boxes text-3xl text-green-500 mr-4"></i>
                <span class="text">
                    <a class="text-2xl font-bold">120</a>
                    <p class="text-gray-600">Products</p>
                </span>
            </li>
            <li class="bg-white p-6 rounded-lg shadow flex items-center">
                <i class="fas fa-shopping-cart text-3xl text-red-500 mr-4"></i>
                <span class="text">
                    <a class="text-2xl font-bold">102</a>
                    <p class="text-gray-600">Purchases</p>
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

        <!-- Last 5 Purchases Section -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-xl font-bold mb-4">Last 5 Purchases</h1>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Product</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Amount</th>
                        <th class="border px-4 py-2">Date/Time</th>
                        <th class="border px-4 py-2">Customer Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Product A</td>
                        <td class="border px-4 py-2">10</td>
                        <td class="border px-4 py-2">$200</td>
                        <td class="border px-4 py-2">2024-08-10 12:30 PM</td>
                        <td class="border px-4 py-2">John Doe</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Product B</td>
                        <td class="border px-4 py-2">5</td>
                        <td class="border px-4 py-2">$150</td>
                        <td class="border px-4 py-2">2024-08-10 11:00 AM</td>
                        <td class="border px-4 py-2">Jane Smith</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Product C</td>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">$100</td>
                        <td class="border px-4 py-2">2024-08-09 09:15 AM</td>
                        <td class="border px-4 py-2">Alice Brown</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Product D</td>
                        <td class="border px-4 py-2">8</td>
                        <td class="border px-4 py-2">$320</td>
                        <td class="border px-4 py-2">2024-08-08 02:45 PM</td>
                        <td class="border px-4 py-2">Bob White</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Product E</td>
                        <td class="border px-4 py-2">3</td>
                        <td class="border px-4 py-2">$90</td>
                        <td class="border px-4 py-2">2024-08-08 10:00 AM</td>
                        <td class="border px-4 py-2">Eve Black</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Sales Chart Script -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [1200, 1900, 3000, 5000, 2000, 3000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Font Awesome (optional, for icons) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

</html>
