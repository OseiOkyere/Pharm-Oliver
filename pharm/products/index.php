<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Management System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 p-8">

    <!-- Add Drug Button and Search Bar -->
    <div class="flex justify-between mb-4">
        <button id="add-drug-btn" class="bg-blue-600 text-white px-4 py-2 rounded">Add Drug</button>
        <input type="text" id="search-bar" placeholder="Search products..." class="border px-4 py-2 rounded">
    </div>

    <!-- Drugs Table -->
    <div class="overflow-x-auto">
        <table id="products-table" class="min-w-full bg-white border rounded">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Quantity</th>
                    <th class="py-2 px-4">Category</th>
                    <th class="py-2 px-4">Supplier</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody id="products-body">
                <!-- Products will be loaded here by JS -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding/Editing Drugs -->
    <div id="drug-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded">
            <h2 id="modal-title" class="text-2xl mb-4">Add New Drug</h2>
            <form id="drug-form">
                <input type="hidden" id="drug-id">
                <div class="mb-4">
                    <label for="name" class="block">Name:</label>
                    <input type="text" id="name" class="border w-full px-2 py-1 rounded">
                </div>
                <div class="mb-4">
                    <label for="description" class="block">Description:</label>
                    <textarea id="description" class="border w-full px-2 py-1 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block">Price:</label>
                    <input type="number" id="price" class="border w-full px-2 py-1 rounded">
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block">Quantity:</label>
                    <input type="number" id="quantity" class="border w-full px-2 py-1 rounded">
                </div>
                <div class="mb-4">
                    <label for="category" class="block">Category:</label>
                    <input type="text" id="category" class="border w-full px-2 py-1 rounded">
                </div>
                <div class="mb-4">
                    <label for="supplier" class="block">Supplier:</label>
                    <input type="text" id="supplier" class="border w-full px-2 py-1 rounded">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="close-modal" class="mr-4 px-4 py-2 bg-gray-600 text-white rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="./products.js"></script>
</body>

</html>
