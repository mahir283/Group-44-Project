<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/AdminDashboardCSS.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Main Content -->
<div class="main-content">
    <header>
        <h1>Welcome to your Dashboard</h1>
    </header>

    <!-- Charts Section (All charts in the same row) -->
    <section class="charts">
        <div class="chart-box">
            <h3>Best Selling Cars</h3>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Sales Month on Month</h3>
            <canvas id="horizontalBarChart"></canvas>
        </div>
        <!-- New Pie Chart for Car Type Distribution -->
        <div class="chart-box">
            <h3>Car Type Sales Distribution</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </section>

    <!-- Overview Section -->
    <section class="overview">
        <div class="box">
            <h3>Total Sales</h3>
            <p>$15,000</p>
        </div>
        <div class="box">
            <h3>Total Products</h3>
            <p>120</p>
        </div>
        <div class="box">
            <h3>Orders</h3>
            <p>45</p>
        </div>
        <div class="box">
            <h3>Active Users</h3>
            <p>89</p>
        </div>
    </section>

    <!-- Notifications Panel (Moved to Bottom) -->
    <section class="notifications-panel">
        <h2>Stock Alerts</h2>
        <div id="notifications-box">
            <div class="notification low-stock">
                <strong>Ford Mustang</strong> is running low! Only 3 left.
            </div>
            <div class="notification low-stock">
                <strong>Chevrolet Camaro</strong> is critically low! Only 1 left.
            </div>
            <div class="notification success">
                <strong>BMW M3</strong> stock is sufficient (15 available).
            </div>
            <div class="notification low-stock">
                <strong>Tesla Model S</strong> is running low! Only 5 left.
            </div>
        </div>
    </section>


</div>

<!-- JavaScript -->
<script src="{{ asset('js/AdminDashboardJS.js') }}"></script>
<script>
    var ctx1 = document.getElementById('lineChart').getContext('2d');
    var ctx2 = document.getElementById('horizontalBarChart').getContext('2d');
    var ctx3 = document.getElementById('pieChart').getContext('2d'); // New pie chart context

    var lineChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [
                {
                    label: '#1 Best Seller',
                    data: [30, 50, 40, 70, 90],
                    borderColor: 'rgba(255, 99, 132, 1)', // Neon Pink
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: '#2 Best Seller',
                    data: [20, 40, 35, 55, 75],
                    borderColor: 'rgba(54, 162, 235, 1)', // Neon Blue
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: '#3 Best Seller',
                    data: [15, 30, 25, 45, 60],
                    borderColor: 'rgba(255, 206, 86, 1)', // Neon Gold
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#ffffff' // White text for dark mode
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255, 255, 255, 0.1)' },
                    ticks: { color: '#ffffff' }
                },
                y: {
                    grid: { color: 'rgba(255, 255, 255, 0.1)' },
                    ticks: { color: '#ffffff' }
                }
            }
        }
    });

    var horizontalBarChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Sales ($)',
                data: [5000, 4000, 7000, 6000, 8000],
                backgroundColor: 'rgba(255, 99, 132, 0.6)',  // Diluted Neon Red
                borderColor: 'rgba(255, 99, 132, 1)', // Darker Red
                borderWidth: 2
            }]
        },
        options: {
            indexAxis: 'y', // Horizontal bar chart
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { color: 'rgba(255, 99, 132, 0.2)' },
                    ticks: { color: '#ffffff' }
                },
                y: {
                    grid: { color: 'rgba(255, 99, 132, 0.2)' },
                    ticks: { color: '#ffffff' }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#ffffff' // White legend text
                    }
                }
            }
        }
    });

    // New Pie Chart for Car Type Distribution with Diluted Neon Colors
    var pieChart = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: ['Hatchback', 'Coupe', 'SUV', 'Saloon', 'Van'],
            datasets: [{
                label: 'Car Type Sales Distribution',
                data: [30, 25, 40, 15, 10], // Example data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Diluted Neon Red for Hatchback
                    'rgba(54, 162, 235, 0.6)', // Diluted Neon Blue for Coupe
                    'rgba(75, 192, 192, 0.6)', // Diluted Neon Green for SUV
                    'rgba(255, 206, 86, 0.6)', // Diluted Neon Yellow for Saloon
                    'rgba(153, 102, 255, 0.6)' // Diluted Neon Purple for Van
                ],
                borderColor: ['#fff', '#fff', '#fff', '#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#ffffff' // White legend text
                    }
                }
            }
        }
    });
</script>

</body>
</html>
