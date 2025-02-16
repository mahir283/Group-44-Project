<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Page</title>
    <link rel="stylesheet" href="{{ asset('css/productsListAdmin.css') }}">
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
<div class = "products-list-admin-container">
    <h1>Products List</h1>
    <div class = "products-info">
        <div class = "items">
            @forelse($cars as $car)
            <div class = "box">
                <img src = "{{ asset($car->car_image) }}" alt = "car-image" width="200" height="150">
                <div class = "products-content">
                <p>Product: {{ $car->car_make }} {{ $car->car_model }}</p>
                <p>Price: £{{ number_format($car->price, 2) }}</p>
                <p>Quantity: {{ $car->quantity }}</p>
                <button class="edit-button">Edit</button>
                <form action="{{ url('/deleteCar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <button class="delete-button" type="submit">Delete</button>
                </form>
                </div>
            </div>
            @empty
                <p>No Products</p>
            @endforelse
        </div>
    </div>
</div>

</body>
</html>
