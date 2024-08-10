$(document).ready(function () {
    // Function to load the page based on the given page URL
    function loadPage(page) {
        $('#main-content').load(`${page}`, function () {
            // Initialize scripts based on the loaded page
            if (page === './dashboard/dashboard.php') {
                initializeDashboardScripts();
            } else if (page === './products/index.php') {
                // Initialize products-related scripts
                initializeProductScripts();
            } else if (page === './sales/index.php') {
                // Initialize sales-related scripts
                initializeSalesScripts();
            } else if (page === './categories/index.php') {
                // Initialize categories-related scripts
                initializeCategoryScripts();
            } else if (page === './suppliers/index.php') {
                // Initialize suppliers-related scripts
                initializeSupplierScripts();
            }

        });

        // Store the last opened page in localStorage
        localStorage.setItem('currentPage', page);
    }

    // Load the last visited page or the default dashboard page
    const lastPage = localStorage.getItem('currentPage') || './dashboard/dashboard.php';
    loadPage(lastPage);

    // Toggle Sidebar
    $('#hamburger').click(function () {
        $('#sidebar').toggleClass('sidebar-expanded sidebar-collapsed');
        $('#main-content').toggleClass('content-expanded');
    });

    // Add listener to the links
    $('nav li').click(function () {
        const page = $(this).data('page');
        loadPage(page);

        // Remove active class from all links
        $('nav li').removeClass('bg-gray-700 text-white');

        // Add active class to the clicked link
        $(this).addClass('bg-gray-700 text-white');
    });

    // Highlight the active sidebar link on page load
    const activeLink = $(`[data-page="${lastPage}"]`);
    if (activeLink) {
        activeLink.addClass('bg-gray-700 text-white');
    }
});



function initializeDashboardScripts() {
    try {
        fetch('./dashboard/fetch_dashboard_data.php')
            .then(response => response.json())
            .then(data => {
                
                // Update sales chart
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.sales_data.map(item => item.date),
                        datasets: [{
                            label: 'Total Sales',
                            data: data.sales_data.map(item => item.total_sales),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                    }
                });
            })
            .catch(error => {
                console.error('Error loading dashboard data:', error);
            });
    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }

}

