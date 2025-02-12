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
                <li><a href ="{{url("/savedCars")}}">Saved Cars</a></li>
                <li><a href="{{ url('/comparePage') }}">Compare Cars</a></li>
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

    <button id="theme-switch">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

    </button>

    @if(session('success'))
        <div class = "successmessage">
        <h3>{{session('success')}}</h3>
        </div>
    @endif






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
        <p id="AndSkipTheWaitAtTheDealership">AND SKIP THE WAIT AT THE DEALERSHIP!</p>
    </div>

    <div class="ColourSectionHomePage">
        <h2 id="VERYFAST">VERY FAST, <span id="VERYSIMPLE">VERY SIMPLE</span></h2>
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
                <p>It's that easy</p>
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
        <div class="carsRandom">
            @foreach($cars as $car)
                <img src=" {{ asset($car->car_image) }} " alt="Car Model" height="300" width="500">
            @endforeach
        </div>
        <br>
        <div class="CheckOutMoreButtonContainer">
            <a href="{{url("/products")}}"><button id="CheckOutMoreButton">CHECK OUT MORE</button></a>
        </div>
        <br>
        <br>
        <div class = "contactUsHomePage">
            <img src = "{{asset("assets/fordFiestaInterior.webp")}}" alt = "" height = "300" width = "450">
            <div class = "text">
                <p id = "title">You matter a lot to us</p>
                <p id = "paragraph">We value all our customers and their needs and wants. Life is all about the little details. Any queries you may have or any issues that may concern you, fill out our form or contact us and we will be in touch with you ASAP.</p>
            </div>
            <div class = "contactUsHomePageButtonContainer">
                <a href="{{url("/contact")}}">
                    <button id = "contactUsHomePageButton">Contact Us</button>
                </a>
            </div>
        </div>
        <br>
        <br>
        <br>

        <footer class="footer">
            <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
        </footer>
    </main>

    <script src="{{ asset('js/darkmode.js') }}"></script>


</div>
</html>


