<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrumBrumm</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<div class="homepageDiv">
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

            <div class="nav-buttons">
                @if (Auth::check())
                    <form method="POST" action = "{{route('userLogout')}}">
                        @csrf
                        <button id="loginButton">Logout</button>
                    </form>
                @else
                    <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
            </div>
            @endif
        </nav>

    </header>

    <div class="imageContainer">
        <img id="BlackSuzuki" src="{{ asset("assets/black Suzuki Swift-Photoroom.png") }}" alt="Black Suzuki Homepage"
             height="400" width="600">
        <img id="BrumBrummBetweenBlackRedCars" src="{{ asset("assets/BrumBrumm-Photoroom.png") }}"
             alt="BrummBrumm Logo between the 2 cars at the homepage" height="250" width="250">
        <img id="RedMerc" src="{{ asset("assets/RedMerc-Photoroom.png") }}" alt="Red Mercedes Homepage" height="400"
             width="600">
    </div>
    <br>
    <div class="SloganHomePage">
        <p id="YourTimeIsValuable">YOUR TIME IS VALUABLE</p>
        <p id="FindYourDesiredVehicleOnline">FIND YOUR DESIRED VEHICLE <span id="OnlineWord">ONLINE</span></p>
        <p id="AndSkipTheWaitAtTheDealership">AND SKIP THE WAIT AT THE DEALERSHIP</p>
    </div>

    <div class="ColourSectionHomePage">
        <h2 id="VERYFAST">VERY FAST <span id="VERYSIMPLE">VERY SIMPLE</span></h2>
        <div class="ColourSectionHomePageContainer">
            <div class="step">
                <img src="{{ asset("assets/accountCircleOnHomePage.png") }}"
                     alt="profile icon for ColourSectionHomePage">
                <p>Login/Sign Up</p>
            </div>
            <div class="step">
                <img src="{{ asset("assets/chevronRight.png") }}" alt="right arrow for ColourSectionHomePage">
            </div>
            <div class="step">
                <img src="{{ asset("assets/searchIconHomePage.png") }}" alt="search icon for ColourSectionHomePage">
                <p>Search for your desired car</p>
            </div>
            <div class="step">
                <img src="{{ asset("assets/chevronRight.png") }}" alt="right arrow for ColourSectionHomePage">
            </div>
            <div class="step">
                <img src="{{ asset("assets/shoppingBasketIconHomePage.png") }}"
                     alt="basket icon for ColourSectionHomePage">
                <p>Add your cars to the basket page</p>
            </div>
            <div class="step">
                <img src="{{ asset("assets/chevronRight.png") }}" alt="right arrow for ColourSectionHomePage">
            </div>
            <div class="step">
                <img src="{{ asset("assets/shoppingCartIconHomePage.png") }}"
                     alt="checkout icon for ColourSectionHomePage">
                <p>Check out and pay for the cars</p>
            </div>
            <div class="step">
                <img src="{{ asset("assets/chevronRight.png") }}" alt="right arrow for ColourSectionHomePage">
            </div>
            <div class="step">
                <img src="{{asset("assets/tickIconHomePage.png")}}" alt="tick icon for ColourSectionHomePage">
                <p>Its that easy</p>
            </div>
        </div>
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
        <div class="carsRandom">
            @foreach($cars as $car)
                <img src=" {{ asset($car->car_image) }} " alt="Car Model" height="400" width="600">
            @endforeach
        </div>
        <br>
        <div class="CheckOutMoreButtonContainer">
            <button id="CheckOutMoreButton">CHECK OUT MORE</button>
        </div>
    </main>
</div>
</html>
