
async function loadDashboardData() {
    try {
        const response = await fetch('./dashboard/fetch_dashboard_data.php'); // Adjust the path as necessary
        const data = await response.json();

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

      
    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }
}

