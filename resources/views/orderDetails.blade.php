<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="{{ asset('css/orderDetails.css') }}">
</head>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
            <li><a href="{{ url('/basketPage') }}">Basket</a></li>
        </ul>

        @if (Auth::check())
            <form method="POST" action="{{ route('userLogout') }}">
                @csrf
                <button id="loginButton">Logout</button>
            </form>
        @else
            <div class="nav-buttons">
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
            </div>
        @endif
    </nav>
</header>
<body>
<div>
<div class = "order-details-container">
     <h1>Your Order</h1>
    <div class="order-info">
        <div class="items">
            <div class="box">
                <img src="" alt="Car image" width="200" height="150">
                <div class="order-content">
                    <p>Product: </p>
                    <p>Price: </p>
                    <p>Quantity: </p>
                    <p>Shipping Address: </p>

                </div>


            </div>
            <p>Total Price: </p>
        </div>
    </div>
</div>

</div>
</body>
</html>
