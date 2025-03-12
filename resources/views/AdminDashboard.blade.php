<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/AdminDashboardCSS.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<body>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href= "{{ url("/") }}">Home</a></li>
            <li><a href="{{ url("/products") }}">Products</a></li>
            <li><a href="{{url("/aboutUs")}}">About Us</a></li>
            <li><a href="{{ url("/contact")}}">Contact Us</a></li>
            <li><a href="{{ url("/basketPage") }}">Basket</a></li>
        </ul>

        <div class="nav-buttons">
            @if (Auth::check())
                @if(Auth::User()->user_type == 'customer')
                    <a href = "{{url('dashboard')}}" class="btn">Dashboard</a>
                @else
                    <a href = "{{url('admin')}}" class="btn">Dashboard</a>
                @endif
                <form method="POST" action = "{{route('userLogout')}}">
                    @csrf
                    <button id="loginButton">Logout</button>
                </form>

            @else
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
        </div>
        @endif
    </nav>
</header>
<!-- Main Content -->
<div class="dashboard-container">
    @if (Auth::check())
        <h1>Welcome to Your Dashboard, {{ Auth::user()->username }}</h1>
        <div class="user-info">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Joined on:</strong> {{ Auth::user()->created_at }}</p>
        </div>

        <div class="user-actions">
            <a href="{{ url('/savedCars') }}" class="btn">Saved Cars</a>
            <a href="{{ url('/edit-profile') }}" class="btn">Edit Profile</a>
            <a href="{{ url('/previous-orders') }}" class="btn">View Orders</a>
            <!-- New Compare Cars Button -->
            <a href="{{ url('/comparePage') }}" class="btn">Compare Cars</a>
            <a href="{{ url('/admin/orders') }}" class="btn">Customer Orders</a>
            <a href="{{ url('/productsListAdmin') }}" class="btn">Inventory</a>
            <a href="{{ url('/customerList') }}" class="btn">Customers</a>
        </div>
    @else
        <p>Please login to access your dashboard.</p>
    @endif
</div>
<div class="main-content">
    <header>
        <h1>BrumBrumm Stats</h1>
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
                @if($alert['status'] == 'low-stock')
                    <div class="notification {{ $alert['status'] }}">
                        <strong>{{ $alert['name'] }}</strong>

                            is running low! Only {{ $alert['quantity'] }} left.

                    </div>
                @endif
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
<script src="{{ asset('js/darkmode.js') }}"></script>

</html>
