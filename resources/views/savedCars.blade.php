<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Cars</title>
    <link rel="stylesheet" href="{{asset('css/savedCars.css')}}">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href= "{{ url("/") }}" >Home</a></li>
            <li><a href="{{ url("/products") }}">Products</a></li>
            <li><a href="{{ url("/aboutUs")}}">About Us</a></li>
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
                    <button id="loginButton" class="btn">Logout</button>
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
<main>
    <div>
        <br>
        <br>
        <br>
    <h1>Your Favourites</h1>
    <br>
    <br>
    <a class="savedList">
        <ul>
            @forelse($savedCars as $savedCar)
                <li>
                    <a href="{{ url('/carDetails/' . $savedCar->car->id) }}">
                        <div class="savedCar">
                            <img src="{{ asset($savedCar->car->car_image) }}" alt="Car Image">
                            <div class="carDetails">
                                <h2>{{ $savedCar->car->car_make }} {{ $savedCar->car->car_model }}</h2>
                                <p>Description: {{ $savedCar->car->car_description }}</p>
                                <p>
                                    Price: £{{ number_format($savedCar->car->price, 2) }} |
                                    Colour: {{ $savedCar->car->colour }} |
                                    Year: {{ $savedCar->car->year }} |
                                    Mileage: {{ $savedCar->car->mileage }} miles |
                                    Fuel Type: {{ $savedCar->car->fuel }} |
                                    Transmission: {{ $savedCar->car->transmission }} |
                                    Body Type: {{ $savedCar->car->category }}
                                </p>

                                <!-- Add to Basket Button -->
                                <form action="{{ url('/basketPage') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="car" value="{{ $savedCar->car->id }}">
                                    <button type="submit">Add to Basket</button>
                                </form>
                                <!-- Remove from Saved Button -->
                                <form action="{{ url('/saveCar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="car_id" value="{{ $savedCar->car->id }}">
                                    <button type="submit">Remove from Saved</button>
                                </form>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <p id = "noSavedCars">You have no saved cars!</p>
            @endforelse
        </ul>
    </a>

    </div>
</main>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
