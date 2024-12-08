<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="{{ asset('css/productsPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}" >
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href= "{{ url("/") }}" class="active" >Home</a></li>
            <li><a href="{{ url("/products") }}">Products</a></li>
            <li><a href="{{url("/aboutUs")}}">About Us</a></li>
            <li><a href="{{ url("/contact")}}">Contact Us</a></li>
            <li><a href="{{ url("/basketPage") }}">Basket</a></li>
        </ul>

        @if (Auth::check())
            <form method="POST" action = "{{route('userLogout')}}">
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

<!-- SEARCH BAR -->
<div class="searchNav">
    <form action="{{ url('/products') }}" method="GET" class="searchBar">

        <input
            type="text"
            name="search"
            placeholder="Search Cars..."
            value="{{ request('search') }}">
        <button type="submit">Go</button>
    </form>
</div>


<div class = "reset">
<a href="{{ url("/products") }}"><button>Reset Search and Filters</button></a>
</div>



<div class="filter">
    <ul>
        <!-- include the current 'search' query in each filter link -->
        <li><a href="{{ url('/products?category=suv&search=' . request('search')) }}">SUV</a></li>
        <li><a href="{{ url('/products?category=saloon&search=' . request('search')) }}">Saloon</a></li>
        <li><a href="{{ url('/products?category=hatchback&search=' . request('search')) }}">Hatchback</a></li>
        <li><a href="{{ url('/products?category=coupe&search=' . request('search')) }}">Coupe</a></li>
        <li><a href="{{ url('/products?category=van&search=' . request('search')) }}">Van</a></li>
    </ul>
</div>

<!-- display the products -->
<div class="row">
    @forelse($cars as $car)
        <div class="column">
            <img
                src="{{ asset($car->car_image) }}"
                style="width: 350px; height: 350px;"
                alt="Car image">
            <h1>{{ $car->car_make }} {{ $car->car_model }}</h1>

            <h3>IN-STOCK: {{ $car->quantity }} | <span class="price">£{{ number_format($car->price, 2) }}</span></h3>
            <p>
                <a href="{{ url('/carDetails/' . $car->id) }}">
                    <button>View</button>
                </a>
            </p>

            <form action="{{ url('/basketPage') }}" method="POST">
                @csrf <!-- token is used for security/validation reasons -->
                <input type="hidden" id="car" name="car" value="{{ $car->id }}">
                <p><button type="submit">Add to Basket</button></p>
            </form>
        </div>
    @empty
        <!-- if no cars match the criteria -->
        <p>No cars found matching criteria.</p>
    @endforelse
</div>
</body>
</html>
