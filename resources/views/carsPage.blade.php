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
            <li><a href= "{{ url("/") }}">Home</a></li>
            <li><a href="{{ url("/products") }}" class="active" >Products</a></li>
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
        <form action="{{ url('/products') }}" method="GET">

            <input type="hidden" name="category" value="{{ request('category') }}">

            <div class="userInput">
                <label>Year:</label>
                <input type="text" name="year_from" placeholder="From" value="{{ request('year_from') }}">
                <input type="text" name="year_to" placeholder="To" value="{{ request('year_to') }}">
            </div>
            <div class="userInput">
                <label>Mileage:</label>
                <input type="text" name="mileage_from" placeholder="From" value="{{ request('mileage_from') }}">
                <input type="text" name="mileage_to" placeholder="To" value="{{ request('mileage_to') }}">
            </div>
            <div class="userInput">
                <label>Transmission:</label>
                <input type="radio" name="transmission" value="Manual" {{ request('transmission') == 'Manual' ? 'checked' : '' }}> Manual
                <input type="radio" name="transmission" value="Automatic" {{ request('transmission') == 'Automatic' ? 'checked' : '' }}> Automatic
            </div>

            <div class="userInput">
                <label>Fuel Type:</label>
                <input type="radio" name="fuel" value="Petrol" {{ request('fuel') == 'Petrol' ? 'checked' : '' }}> Petrol
                <input type="radio" name="fuel" value="Diesel" {{ request('fuel') == 'Diesel ' ? 'checked' : '' }}> Diesel
            </div>
            <div class="userInput">
                <label>Colour:</label>
                <input type="checkbox" name="colour[]" value="Blue" {{ is_array(request('colour')) && in_array('Blue', request('colour')) ? 'checked' : '' }}> Blue
                <input type="checkbox" name="colour[]" value="Black" {{ is_array(request('colour')) && in_array('Black', request('colour')) ? 'checked' : '' }}> Black
                <input type="checkbox" name="colour[]" value="Grey" {{ is_array(request('colour')) && in_array('Grey', request('colour')) ? 'checked' : '' }}> Grey
                <input type="checkbox" name="colour[]" value="White" {{ is_array(request('colour')) && in_array('White', request('colour')) ? 'checked' : '' }}> White
            </div>
            <div class="userInput">
                <label>Price:</label>
                <input type="text" name="price_from" placeholder="From">
                <input type="text" name="price_to" placeholder="To">
            </div>
            <div class="buttons">
                <button type="submit">Apply</button>
            </div>
        </form>
    </div>


</div>



<div class="filter">
    <ul>
        <!-- include the current 'search' query in each filter link -->
        <li><a href="{{ url('/products?category=suv&' . http_build_query(request()->except('category'))) }}">SUV</a></li>
        <li><a href="{{ url('/products?category=saloon&' . http_build_query(request()->except('category'))) }}">Saloon</a></li>
        <li><a href="{{ url('/products?category=hatchback&' . http_build_query(request()->except('category'))) }}">Hatchback</a></li>
        <li><a href="{{ url('/products?category=coupe&' . http_build_query(request()->except('category'))) }}">Coupe</a></li>
        <li><a href="{{ url('/products?category=van&' . http_build_query(request()->except('category'))) }}">Van</a></li>
    </ul>
</div>

<!-- display the products -->
<div class="row">
    @forelse($cars as $car)
        <div class="column">
            <img
                src="{{ asset($car->car_image) }}"
                style="width: 350px; height: 250px;"
                alt="Car image">

            <h1>{{ $car->car_make }} {{ $car->car_model }}</h1>

            <h3>
                IN-STOCK:
                @if($car->quantity > 0)
                    {{ $car->quantity }}
                @else
                    <span style="color: red; font-weight: bold;">OUT OF STOCK</span>
                @endif
                | <span class="price">£{{ number_format($car->price, 2) }}</span>
            </h3>

            <p>
                <a href="{{ url('/carDetails/' . $car->id) }}">
                    <button>View</button>
                </a>
            </p>

            <!-- Heart button to save product -->
            <form action="{{ url('/saveCar') }}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                @isset($savedCars)
                    @if(in_array($car->id, $savedCars))
                        <p><button type="submit">Unsave</button></p>
                    @else
                        <p><button type="submit">Save</button></p>
                    @endif
                @endisset
            </form>

            @if($car->quantity > 0)
                <form action="{{ url('/basketPage') }}" method="POST">
                    @csrf <!-- token is used for security/validation reasons -->
                    <input type="hidden" id="car" name="car" value="{{ $car->id }}">
                    <p><button type="submit">Add to Basket</button></p>
                </form>
            @endif
        </div>
    @empty
        <!-- if no cars match the criteria -->
        <p>No cars found matching criteria.</p>
    @endforelse
</div>


<script src="{{ asset('js/darkmode.js') }}"></script>
</body>
</html>
