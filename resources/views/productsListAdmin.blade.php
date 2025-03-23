<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products List</title>
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
    <form action="{{ route('productsListAdmin') }}" method="GET" class="listForm">
        <input type="text" name="search" class="search" placeholder="Search Car">
        <button type="submit" class="btn">Search</button>
    </form>
    <script src = "{{ asset('js/filter.js') }}"></script>
    <div class = "reset">
        <a href="{{ route("productsListAdmin") }}"><button>Reset Search and Filters</button></a>
        <button id = "filterButton" class = "filterButton" onclick = "toggleFilter()">Filters</button>
        <div id = "filter" class = "myFilters">
            <h3>Filters</h3>
            <form action="{{ route('productsListAdmin') }}" method="GET">

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
            <li><a href="{{ url('/productsListAdmin?category=suv&' . http_build_query(request()->except('category'))) }}">SUV</a></li>
            <li><a href="{{ url('/productsListAdmin?category=saloon&' . http_build_query(request()->except('category'))) }}">Saloon</a></li>
            <li><a href="{{ url('/productsListAdmin?category=hatchback&' . http_build_query(request()->except('category'))) }}">Hatchback</a></li>
            <li><a href="{{ url('/productsListAdmin?category=coupe&' . http_build_query(request()->except('category'))) }}">Coupe</a></li>
            <li><a href="{{ url('/productsListAdmin?category=van&' . http_build_query(request()->except('category'))) }}">Van</a></li>
        </ul>
    </div>

    <div class="addBtn">
    <a href="{{ url("/addCar") }}"><button class="edit-button" type="submit">Add Product</button></a>
    </div>
    @if(session('success'))
        <div class = "successmessage">
            <h3>{{session('success')}}</h3>
        </div>
    @endif
    <div class = "products-info">
        <div class = "items">
            @forelse($cars as $car)
            <div class = "box">
                <img src = "{{ $car->car_image}}" alt = "car-image" width="200" height="150">
                <div class = "products-content">
                <p>Product: {{ $car->car_make }} {{ $car->car_model }}</p>
                <p>Price: £{{ number_format($car->price, 2) }}</p>
                <p>Quantity: {{ $car->quantity }}</p>
                <form action ="{{url('/adminEditCar')}}" method = "POST">
                    @csrf
                    <input type = "hidden" name = "car_id" value = "{{$car->id}}">
                    <button class="edit-button" type="submit">Edit</button>
                </form>

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
