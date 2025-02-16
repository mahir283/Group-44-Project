<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Previous Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/previousorders.css') }}" />
</head>
<body>
<div class="homepageDiv">

    <header>
        <nav class="navbar">
            <div class="logo">BRUMBRUMM</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="active">HOME</a></li>
                <li><a href="{{ url('/products') }}">PRODUCTS</a></li>
                <li><a href="{{ url('/aboutUs') }}">ABOUT US</a></li>
                <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
                <li><a href="{{ url('/basketPage') }}">BASKET</a></li>
            </ul>

            <div class="nav-buttons">
                @if (Auth::check())
                    <form method="POST" action="{{ route('userLogout') }}">
                        @csrf
                        <button id="loginButton">LOGOUT</button>
                    </form>
                @else
                    <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                    <a href="{{ url('registerUser') }}" class="btn register">Register</a>
                @endif
            </div>
        </nav>
    </header>

    <div class="content">
        @if ($orders->isEmpty())
            <h1>You have no previous orders</h1>
            <p>Start shopping today and your previous orders will appear here!</p>
        @else
            <h1>Your Previous Orders</h1>
            <p>Here are the details of your past orders:</p>

            <div class="order-boxes">
                @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="order-details">
                            <h2>Order ID: {{ $order->id }}</h2> <!-- Displaying only the order ID -->
                            <p><strong>Card Name:</strong> {{ $order->cardname }}</p>
                            <p><strong>Card Number:</strong> {{ $order->cardnumber }}</p>
                            <p><strong>Expiry Date:</strong> {{ $order->expire_month }}/{{ $order->expire_year }}</p>
                            <p><strong>CVV:</strong> {{ $order->cvv }}</p>
                            <p><strong>User ID:</strong> {{ $order->user_id }}</p>

                            <!-- The action button (updated text to 'View Order') -->
                            <div class="order-actions">
                                <a href="{{ url('/order-details/' . $order->id) }}">
                                    <button type="submit" class="btn">View Order</button>
                                </a>

                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        @endif
    </div>
</div>
</body>
</html>
