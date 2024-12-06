<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketPage</title>
    <link rel="stylesheet" href="{{ asset("css/basketpage.css") }}">
</head>
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
<body>
<div class="wrapper">
    <h1>Your Basket</h1>
    <div class="project">
        <div class="shop">
            <div class="box">
                <img src="{{asset("assets/toyota yaris 2002.jpeg")}}" alt="">
                <div class="content">
                    <h3>Poosi Wagoon (Jaan Magnet Package)</h3>
                    <h4>Price: £1000</h4>
                    <p class="unit"> Quantity: <input value="2"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="box2">
                <img src="{{asset("assets/audi a4 2008.jpeg")}}" alt="">
                <div class="content">
                    <h3>Nani Ji's Friday Night (Lengha Included)</h3>
                    <h4>Price: £1200</h4>
                    <p class="unit"> Quantity: <input value="3"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="box3">
                <img src="{{asset("assets/ford ka 2003.jpeg")}}" alt="">
                <div class="content">
                    <h3>Meri Jaan's Gaddiyaan</h3>
                    <h4>Price: £850 (special price)</h4>
                    <p class="unit"> Quantity: <input value="1"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="box4">
                <img src="{{asset("assets/audi q7.jpeg")}}" alt="">
                <div class="content">
                    <h3>SUV SMD</h3>
                    <h4>Price: £1500 (SUV standard)</h4>
                    <p class="unit"> Quantity: <input value="1"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="box5">
                <img src="{{asset("assets/toyota hiace.jpeg")}}" alt="">
                <div class="content">
                    <h3>Widebooty</h3>
                    <h4>Price: £1750 (special price)</h4>
                    <p class="unit"> Quantity: <input value="1"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="box6">
                <img src="{{asset("assets/yellow weird car.jpg")}}" alt="">
                <div class="content">
                    <h3>Rishta for Pooja</h3>
                    <h4>Price: £1100 (special price)</h4>
                    <p class="unit"> Quantity: <input value="1"></p>
                    <p class="button-area">
                        <i class="trash"></i>
                        <span class="btn2">Remove</span>
                    </p>
                </div>
            </div>
            <div class="bottom-bar">
                <p><span>Subtotal:</span> <span>£3050</span></p>
                <hr>
                <p><span>Tax (5%)</span> <span>£152.50</span></p>
                <hr>
                <p><span>Shipping:</span> <span>£10</span></p>
                <hr>
                <p><span>Total: </span> <span>£3212.50</span></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
