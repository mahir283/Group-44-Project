<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Page</title>
    <link rel="stylesheet" href="{{ asset('css/basketpage.css') }}">
</head>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href= "{{ url("/") }}" class="active" >Home</a></li>
            <li><a href="{{ url("/products") }}">Products</a></li>
            <li><a href="{{ url("/aboutUs") }}">About Us</a></li>
            <li><a href="{{ url("/contact") }}">Contact Us</a></li>
            <li><a href="{{ url("/basketPage") }}">Basket</a></li>
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
<div class="wrapper">
    <h1>Your Basket</h1>
    <div class="project">
        <div class="shop">
            @foreach ($basketItems as $item)
                <div class="box">
                    <img src="{{ asset($item->car->car_image) }}" alt="Car image" width="200" height="150">
                    <div class="content">
                        <h3>{{ $item->car->car_make }} {{ $item->car->car_model }}</h3>
                        <h4>Price: £{{ number_format($item->car->price, 2) }}</h4>

                        <!-- Quantity Form -->
                        <form action="{{ route('basket.updateQuantity', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input">
                            <button type="submit" class="btn2">Update Quantity</button>
                        </form>

                        <p>Total Price: £{{ number_format($item->car->price * $item->quantity, 2) }}</p>

                        <!-- Remove Button Form -->
                        <form action="{{ route('basket.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn2">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Basket Summary -->
            <div class="bottom-bar">
                <p><span>Subtotal:</span> <span>£{{ number_format($subtotal, 2) }}</span></p>
                <hr>
                <p><span>Tax (5%)</span> <span>£{{ number_format($tax, 2) }}</span></p>
                <hr>
                <p><span>Shipping:</span> <span>£{{ number_format($shipping, 2) }}</span></p>
                <hr>
                <p><span>Total: </span> <span>£{{ number_format($total, 2) }}</span></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
