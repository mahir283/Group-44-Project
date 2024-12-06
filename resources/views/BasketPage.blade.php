<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketPage</title>
    <link rel="stylesheet" href="{{ asset("css/basketpage.css") }}">
</head>
<header>
    <a href="{{ url("/") }}">
        <img src="{{ asset("assets/BrumBrumm.png") }}" alt="image" width="150" height="100">
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
    <img id="profileImage" src="{{ asset("assets/profile avatar neww.png") }}" height="75" height="75">
    <a href="{{ url("BasketPage.blade.php.html") }}">
        <img id="basketImage" src="{{ asset("assets/basket avatar for nav bar.jpg") }}" height="75" height="75">
    </a>
</header>
<body>
<div class="wrapper">
    @forelse($basket as $item)
        <h1>Your Basket</h1>
        <div class="project">
            <div class="shop">
                <div class="box">
                    <img src="{{asset("$item->car_image")}}" alt="">
                    <div class="content">
                        <h3>{{ $item->car_make }} {{ $item->car_model }}</h3>
                        <h4></h4>
                        <p class="unit"> Quantity: <input value="2"></p>
                        <p class="button-area">
                            <i class="trash"></i>
                            <span class="btn2">Remove</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    @empty
        <p>Your basket is empty.</p>
    @endforelse
        <div class="bottom-bar">
            <p><span>Subtotal:</span> <span>£{{ $subtotal }}</span></p>
        </div>


</body>
</html>
