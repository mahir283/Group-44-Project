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
            <p>Here are the cars you have previously ordered. Browse and reorder anytime!</p>

            <div class="order-boxes">
                @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="order-image">
                            <img src="{{ asset('assets/' . $order->car->car_image) }}" alt="Car Image" />
                        </div>
                        <div class="order-details">
                            <h2>{{ $order->car->car_model }}</h2>
                            <p><strong>Price:</strong> ${{ $order->car->price }}</p>
                            <p><strong>Color:</strong> {{ $order->car->colour }}</p>
                            <p><strong>Year:</strong> {{ $order->car->year }}</p>
                            <p><strong>Mileage:</strong> {{ $order->car->mileage }} miles</p>
                            <p><strong>Fuel Type:</strong> {{ $order->car->fuel }}</p>
                            <p><strong>Transmission:</strong> {{ $order->car->transmission }}</p>

                            <div class="order-actions">
                                <!-- View Details Button (now a <button>) -->
                                <form action="{{ route('car.details', $order->car->id) }}" method="GET" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn">View Details</button>
                                </form>


                                <form action="{{ route('addToBasket', $order->car->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="car" value="{{ $order->car->id }}" />
                                    <button type="submit" class="btn">Reorder</button>
                                </form>
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
