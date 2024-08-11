$(document).ready(function () {
    function loadProducts() {
        $.ajax({
            url: './fetch_products.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                const { products, categories, suppliers } = data;

                // Populate products table
                const tableBody = $('#products-table tbody');
                tableBody.empty();
                products.forEach(product => {
                    const row = `
                    <tr>
                        <td class="py-2 px-4 border">${product.name}</td>
                        <td class="py-2 px-4 border">${product.description || ''}</td>
                        <td class="py-2 px-4 border">${product.price}</td>
                        <td class="py-2 px-4 border">${product.quantity}</td>
                        <td class="py-2 px-4 border">${product.category || ''}</td>
                        <td class="py-2 px-4 border">${product.supplier || ''}</td>
                        <td class="py-2 px-4 border">
                            <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded" data-id="${product.id}">Edit</button>
                            <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded" data-id="${product.id}">Delete</button>
                        </td>
                    </tr>`;
                    tableBody.append(row);
                });

                // Populate categories and suppliers dropdowns in the modal
                const categorySelect = $('#category');
                const supplierSelect = $('#supplier');
                categorySelect.empty();
                supplierSelect.empty();
                
                categories.forEach(category => {
                    categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                });
                
                suppliers.forEach(supplier => {
                    supplierSelect.append(`<option value="${supplier.id}">${supplier.name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'Failed to load data', 'error');
            }
        });
    }

    // Open the Add Product modal
    $('#add-product-btn').on('click', function () {
        Swal.fire({
            title: 'Add New Product',
            html: $('#add-product-modal').html(),
            showCancelButton: true,
            focusConfirm: false,
            preConfirm: () => {
                const formData = {
                    name: $('#swal2-html-container #name').val(),
                    description: $('#swal2-html-container #description').val(),
                    price: $('#swal2-html-container #price').val(),
                    quantity: $('#swal2-html-container #quantity').val(),
                    category_id: $('#swal2-html-container #category').val(),
                    supplier_id: $('#swal2-html-container #supplier').val(),
                };
                return formData;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './add_product.php',
                    type: 'POST',
                    data: result.value,
                    success: function () {
                        Swal.fire('Success', 'Product added successfully', 'success');
                        loadProducts();
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to add product', 'error');
                    }
                });
            }
        });
    });

    // Initialize product list
    loadProducts();
});
