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
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
