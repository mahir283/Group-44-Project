<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrumBrumm</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}" >
</head>
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

    @if (Auth::check())
        <img id="profileImage" src="{{ asset('assets/profile avatar neww.png') }}" alt="Profile Picture Image" width="75" height="75">
        <img id="basketImage" src="{{ asset('assets/basket avatar for nav bar.jpg') }}" alt="Basket Picture Image" width="75" height="75">
        <div class="logMessage">
            <p style="color: #e2e8f0">Welcome, {{ Auth::user()->first_name }}</p>
        </div>
        @if (Auth::check())
            <form method="POST" action = "{{route('userLogout')}}">
                @csrf
                <button id="loginButton">Logout</button>
            </form>
        @endif
    @else

        <div class="loginSignupButtons">
            <a href="{{ url('/userLogin') }}">
                <button id="loginButton">Login</button>
            </a>
            <a href="{{ url('/userRegister') }}">
                <button id="registerButton">Register</button>
            </a>
        </div>
    @endif
</header>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        {{Auth::id()}}
    </div>
@endif
<div>
    <img id="BlackSuzuki" src="{{ asset("assets/black Suzuki Swift-Photoroom.png") }}" alt="Black Suzuki Homepage" height="400" width="600">
    <img id="BrumBrummBetweenBlackRedCars" src="{{ asset("assets/BrumBrumm-Photoroom.png") }}" alt="BrummBrumm Logo between the 2 cars at the homepage" height="250" width="250">
    <img id="RedMerc" src="{{ asset("assets/RedMerc-Photoroom.png") }}" alt="Red Mercedes Homepage" height="400" width="600">
</div>
<br>
<div class="SloganHomePage">
    <p id="YourTimeIsValuable">YOUR TIME IS VALUABLE</p>
    <p id="FindYourDesiredVehicleOnline">FIND YOUR DESIRED VEHICLE <span id="OnlineWord">ONLINE</span></p>
    <p id="AndSkipTheWaitAtTheDealership">AND SKIP THE WAIT AT THE DEALERSHIP</p>
</div>

<div class="ColourSectionHomePage">
    <h2 id="VERYFAST">VERY FAST <span id="VERYSIMPLE">VERY SIMPLE</span></h2>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
<br>
<br>
<main>
    <div>
        <h1 id="FindYourBrumBrumm">FIND YOUR BRUMBRUMM!</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div>
        @foreach($cars as $car)
            <img src=" {{ asset($car->car_image) }} " alt="Car Model" height="400" width ="600">
        @endforeach
    </div>
    <br>
    <div class="CheckOutMoreButtonContainer">
        <button id="CheckOutMoreButton">CHECK OUT MORE</button>
{{--        @if (Auth::check())--}}
{{--        <form method="POST" action = "{{route('userLogout')}}">--}}
{{--            @csrf--}}
{{--            <button id="loginButton">Logout</button>--}}
{{--        </form>--}}
{{--        @endif--}}

        </div>

    </div>

</main>
</html>
