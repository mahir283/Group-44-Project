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
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
            <li><a href="{{ url('/basketPage') }}" class="active">Basket</a></li>
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
                    <button id="loginButton" class = "btn">Logout</button>
                </form>

            @else
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
        </div>
        @endif
    </nav>
</header>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
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
                            <button type="submit" class="btn3">Remove</button>
                        </form>
                    </div>
                </div>

            @endforeach

            <!-- Basket Summary -->
            <div class="bottom-bar">
                <p><span>Total:</span> <span>£{{ number_format($subtotal, 2) }}</span></p>

            </div>

            <!-- Checkout Button -->
                @if ($subtotal)
                    <div class="chkbuttondiv">
                        <a href="{{ url('/checkout') }}" class="checkout-button">Checkout</a>
                    </div>
                @else
                    <div class="basketempty">
                        <h3>Your basket is empty, add a car to proceed to checkout!</h3>
                    </div>
                @endif
        </div>
    </div>
</div>
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
