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
            <p>£{{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="box">
            <h3>Total Products</h3>
            <p>{{ $totalProducts }}</p>
        </div>
        <div class="box">
            <h3>Orders</h3>
            <p>{{ $totalOrders }}</p>
        </div>
        <div class="box">
            <h3>Active Users</h3>
            <p>{{ $activeUsers }}</p>
        </div>
    </section>

    <!-- Notifications Panel -->
    <section class="notifications-panel">
        <h2>Stock Alerts</h2>
        <div id="notifications-box">
            @foreach($stockAlerts as $alert)
                <div class="notification {{ $alert['status'] }}">
                    <strong>{{ $alert['name'] }}</strong>
                    @if($alert['status'] == 'low-stock')
                        is running low! Only {{ $alert['quantity'] }} left.
                    @else
                        stock is sufficient ({{ $alert['quantity'] }} available).
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <!-- Queries Panel -->
    <section class="notifications-panel">
        <h2>Customer Queries</h2>
        <div id="notifications-box">
            @foreach($queries as $queryItem)
                <div class="notification">

                    <strong>{{ $queryItem-> first_name}} {{$queryItem-> last_name}}: {{$queryItem-> message}}</strong>



                </div>
            @endforeach
        </div>
    </section>




</div>

<!-- JavaScript -->
<script src="{{ asset('js/AdminDashboardJS.js') }}"></script>
<script>
    var bestSellingCars = @json($bestSellingCars);
    var monthlySales = @json($monthlySales);
    var carTypeSales = @json($carTypeSales);

    var ctx1 = document.getElementById('lineChart').getContext('2d');
    var ctx2 = document.getElementById('horizontalBarChart').getContext('2d');
    var ctx3 = document.getElementById('pieChart').getContext('2d');

    var lineChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: bestSellingCars.map(car => car.car_model),
            datasets: [{
                label: 'Best Sellers',
                data: bestSellingCars.map(car => car.total_sold),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    var horizontalBarChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: monthlySales.map(sale => sale.month),
            datasets: [{
                label: 'Sales ($)',
                data: monthlySales.map(sale => sale.total_sales),
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            indexAxis: 'y'
        }
    });

    var pieChart = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: carTypeSales.map(type => type.category),
            datasets: [{
                label: 'Car Type Sales Distribution',
                data: carTypeSales.map(type => type.total_sold),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: ['#fff', '#fff', '#fff', '#fff', '#fff'],
                borderWidth: 1
            }]
        }
    });
</script>


</body>
</html>
