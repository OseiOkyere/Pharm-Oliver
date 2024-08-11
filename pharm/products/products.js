$(document).ready(function () {
  
    function loadProducts() {
        $.ajax({
            url: './products/fetch_products.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                const { products, categories, suppliers } = data;

                // Populate products table
                const tableBody = $('#products-table tbody');
                tableBody.empty();
                products.forEach(product => {
                    const row = `
                    <tr data-id="${product.id}" data-name="${product.name}" data-description="${product.description}" data-price="${product.price}" data-quantity="${product.quantity}" data-category="${product.category}" data-supplier="${product.supplier}">
                        <td class="py-2 px-4 border">${product.id}</td>
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
        $('#modal-title').text('Add New Product');
        $('#product-form')[0].reset(); // Clear the form
        $('#drug-id').val(''); // Clear hidden ID field
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
                    url: './products/add_product.php',
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

    // Open Edit Modal on Edit Button Click
    $(document).on('click', '.edit-btn', function () {
        const productRow = $(this).closest('tr');
        const id = productRow.data('id');
        const name = productRow.data('name');
        const description = productRow.data('description');
        const price = productRow.data('price');
        const quantity = productRow.data('quantity');
        const category = productRow.data('category');
        const supplier = productRow.data('supplier');

        Swal.fire({
            title: 'Edit Product',
            html: $('#add-product-modal').html(),
            showCancelButton: true,
            focusConfirm: false,
            preConfirm: () => {
                const formData = {
                    id,
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
                    url: './products/edit_product.php',
                    type: 'POST',
                    data: result.value,
                    success: function () {
                        Swal.fire('Success', 'Product updated successfully', 'success');
                        loadProducts();
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to update product', 'error');
                    }
                });
            }
        });

        // Populate the modal with the existing product data
        $('#swal2-html-container #name').val(name);
        $('#swal2-html-container #description').val(description);
        $('#swal2-html-container #price').val(price);
        $('#swal2-html-container #quantity').val(quantity);
        $('#swal2-html-container #category').val(category);
        $('#swal2-html-container #supplier').val(supplier);
    });

    // Delete Product
    $(document).on('click', '.delete-btn', function () {
        const productId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './products/delete_product.php',
                    type: 'POST',
                    data: { id: productId },
                    success: function () {
                        Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                        loadProducts();
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to delete product', 'error');
                    }
                });
            }
        });
    });

    // Initialize product list
    loadProducts();
});
