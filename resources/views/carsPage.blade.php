<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="{{ asset('css/productsPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}" >
    <script src = "{{ asset('js/filter.js') }}"></script>
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

<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>


</button>

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

<script src="{{ asset('js/filter.js') }}"></script>
<div class = "reset">
<a href="{{ url("/products") }}"><button>Reset Search and Filters</button></a>
    <button id = "filterButton" class = "filterButton" onclick = "toggleFilter()">Filters</button>
    <div id = "filter" class = "myFilters">
        <h3>Filters</h3>
        <form>
            <div class="userInput">
                <label>Year</label>
                <input type="text" placeholder="From">
                <input type="text" placeholder="To">
            </div>
            <div class="userInput">
                <label>Mileage</label>
                <input type="text" placeholder="From">
                <input type="text" placeholder="To">
            </div>
            <div class="userInput">
                <label>Transmission</label>
                <input type="radio" name="transmission" value="Petrol"> Petrol
                <input type="radio" name="transmission" value="Diesel"> Diesel
            </div>
            <div class="userInput">
                <label>Colour</label>
                <input type="checkbox" name="colour" value="Blue"> Blue
                <input type="checkbox" name="colour" value="Black"> Black
                <input type="checkbox" name="colour" value="Grey"> Grey
                <input type="checkbox" name="colour" value="White"> White
            </div>
            <div class="userInput">
                <label>Price</label>
                <input type="text" placeholder="From">
                <input type="text" placeholder="To">
            </div>
            <div class="buttons">
                <button type="button">Apply</button>
                <button type="button">Reset</button>
            </div>
        </form>
    </div>


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

<script src="{{ asset('js/darkmode.js') }}"></script>
</body>
</html>
