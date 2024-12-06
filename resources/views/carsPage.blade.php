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

<!-- NAVIGATION BAR -->
<header>
    <a href="{{ url("/") }}">
        <img src="{{ asset('assets/BrumBrumm.png') }}" alt="image" width="150" height="100">
    </a>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <a href="{{ url("/products" ) }}"><h2 id="carButtonNavBar">Cars</h2></a>
    <h1></h1>
    <h1></h1>
    <a href="{{ url("/contact") }}"><h2 id="contactButtonNavBar">Contact</h2></a>
    <h1></h1>
    <h1></h1>
    <h2 id="aboutButtonNavBar">About</h2>
    <br>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <img id="profileImage" src="{{ asset('assets/profile avatar neww.png') }}" alt="Profile Picture Image" width="75" height="75">
    <img id="basketImage" src="{{ asset('assets/basket avatar for nav bar.jpg') }}" alt="Basket Picture Image" width="75" height="75">
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

<!-- FILTER LINKS -->
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

            <p>IN-STOCK: {{ $car->quantity }}</p>
            <p class="price">£{{ number_format($car->price, 2) }}</p>
            <p>
                <a href="{{ url('/carDetails/' . $car->id) }}">
                    <button>View</button>
                </a>
            </p>
            <p><button>Add to Basket</button></p>
        </div>
    @empty
        <!-- if no cars match the criteria -->
        <p>No cars found matching criteria.</p>
    @endforelse
</div>
</body>
</html>
