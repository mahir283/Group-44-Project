<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="{{ asset('css/adminList.css') }}">
</head>

<nav class="navbar">
    <div class="logo">BrumBrumm</div>
    <ul class="nav-links">
        <li><a href= "{{ url("/") }}" >Home</a></li>
        <li><a href="{{ url("/products") }}">Products</a></li>
        <li><a href="{{ url("/aboutUs")}}">About Us</a></li>
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
                <button id="loginButton" class="btn">Logout</button>
            </form>

        @else
            <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
            <a href="{{ url('registerUser') }}" class="btn register">Register</a>
    </div>
    @endif

</nav>

<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<body>
@if(Auth::check() && Auth::user()->user_type == 'admin')

<main class="table" id="customers_table">
    <section class="table__header">
        <h1> Admin Orders</h1>
    </section>

    <section class="status-message">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </section>
    <div class="search-container">
        <form method="GET" action=" {{route('admin.orders')}}" class="search-container">
            <input class = "search-bar" type="text" name="search" value="{{request('search')}}" placeholder="Search by Name or Order Number...">
            <button class = "search-button" type="submit">Search</button>

        </form>
        <script src = "{{ asset('js/filter.js') }}"></script>
        <button id = "filterButton" class = "filterButton" onclick = "toggleFilter()">Filters</button>
        <a href="{{ route('admin.orders') }}">
            <button type="button" class="filterButton">Reset</button>
        </a>
    </div>
    <div id= "filter" class="myFilters">
        <h3>Filters</h3>
        <form action="{{ route('admin.orders') }}" method="GET">
            <div class="userInput">
                <label>Price:</label>
                <input type="text" name="price_from" placeholder="From" value="{{ request('price_from') }}">
                <input type="text" name="price_to" placeholder="To" value="{{ request('price_to') }}">
            </div>

            <div class="userInput">
                <label>Status:</label>
                <input type="radio" name="status" value="confirmed" {{ request('status') == 'confirmed' ? 'checked' : '' }}>Order Placed
                <input type="radio" name="status" value="processing" {{ request('status') == 'processing' ? 'checked' : '' }}>Preparing Order
                <input type="radio" name="status" value="shipped" {{ request('status') == 'shipped' ? 'checked' : '' }}>Ready to Collect
                <input type="radio" name="status" value="delivered" {{ request('status') == 'delivered' ? 'checked' : '' }}>Collected
            </div>

            <div class="buttons">
                <button type="submit">Apply</button>
            </div>
        </form>
        </div>



    <section class="table__body">
        <table>
            <thead>
            <tr>
                <th> Order Number </th>
                <th> Customer Name </th>
                <th> Order Date </th>
                <th> Order Status </th>
                <th> Order Amount </th>
                <th> Order Price</th>
                <th> Actions</th>
                <th> Delete </th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order['order_number'] }}</td>
                    <td>{{ $order['customer_name'] }}</td>
                    <td>{{ $order['order_date'] }}</td>
                    <td>
                        @if($order['order_status'] == 'confirmed')<p>Order Placed</p>
                        @elseif($order['order_status'] == 'processing')<p>Preparing Order</p>
                        @elseif($order['order_status']== 'shipped')<p>Ready to Collect</p>
                        @elseif($order['order_status'] == 'delivered')<p>Collected!</p>
                        @endif
                    </td>
                    <td><strong>{{ $order['number_of_items'] }}</strong></td>
                    <td><strong>£{{ number_format($order['order_price'], 2) }}</strong></td>
                    <td>
                        <a href="{{ route('admin.order.details', ['orderId' => $order['order_number']]) }}" class="view-btn">View</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="order_id" value="{{ $order['order_number'] }}">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</main>
@endif
</body>
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <ul>
                <li><a href="https://www.instagram.com"><img src ="{{asset("assets/insta (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://www.facebook.com"><img src = "{{asset("assets/facebook (1).png")}}" height = "27" width = "27"></a></li>
                <li><a href="https://x.com/?lang=en"><img src = "{{asset("assets/X (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://telegram.org"><img src = "{{asset("assets/telegram (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://uk.linkedin.com"><img src = "{{asset("assets/linkedin (1).png")}}" height = "25" width = "25"></a></li>
            </ul>
        </div>
        <div class="footer-center">
            <h1>brumbrumm</h1>
            <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
        </div>
        <div class="footer-right">
            <p>Email: BrumBrummManagement@gmail.com</p>
            <p>Phone: +44 7847357490</p>
        </div>
    </div>
</footer>
<script src="{{ asset('js/darkmode.js') }}"></script>

</html>
