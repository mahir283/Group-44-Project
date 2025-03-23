<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrumBrumm</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productsPage.css') }}">

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

    @if(session('success'))
        <div class = "successmessage">
        <h3>{{session('success')}}</h3>
        </div>
    @endif






    <div class="imageContainer">

        <img id="BrumBrummLogo" src="{{ asset("assets/brumlight.png") }}"
             alt="BrummBrumm Logo" >
        <div class="SloganHomePage">
            <p id="YourTimeIsValuable">NEED A CHEAP AND RELIABLE USED CAR? </p>
            <p id="FindYourDesiredVehicleOnline">WELCOME TO <span id="OnlineWord">BRUMBRUMM!</span></p>
            <p id="AndSkipTheWaitAtTheDealership">FIND YOUR DREAM CAR AND SKIP THE WAIT AT THE DEALERSHIP!</p>
        </div>

    </div>
    <br>


    <div class="ColourSectionHomePage">
        <h2 id="VERYFAST">BUY YOUR NEXT CAR<span id="VERYSIMPLE">IN 5 EASY STEPS</span></h2>
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
            @endforeach

        </div>
        <br>
        <div class="CheckOutMoreButtonContainer">
            <a href="{{url("/products")}}"><button id="CheckOutMoreButton">View All Cars</button></a>
        </div>
        <br>
        <br>
        <div class = "contactUsHomePage">
            <img src = "{{asset("assets/carkey.png")}}" alt = "" height = "300" width = "450">
            <div class = "text">
                <p id = "title">WE PUT YOU FIRST</p>
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
    </main>

    <script src="{{ asset('js/darkmodeH.js') }}"></script>


</div>
</html>


