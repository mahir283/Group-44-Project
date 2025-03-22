<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="{{ asset('css/orderDetails.css') }}">
</head>
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
                    <button id="loginButton">Logout</button>
                </form>

            @else
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
        </div>
        @endif
    </nav>
    <button id="theme-switch">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

    </button>

</header>
<body>
<div>
    <div class = "order-details-container">
        <h1>Your Order</h1>
        <h1>Order #{{$order->id}}</h1>

        @if(!$subtotal)
            <h1>All items in this order have been returned :(</h1>
        @endif
        <div class="order-info">
            <div class="items">
                @foreach($items as $item)
                    <div class="box">
                        <img src="{{asset($item->car->car_image)}}" alt="Car image" width="200" height="150">
                        <div class="order-content">
                            <p>Vehicle: {{$item->car->car_make}} {{$item->car->car_model}} </p>
                            <p>Quantity: {{$item->order_quantity}} </p>
                            <p>Price: {{$item->order_quantity}}x £{{ number_format($item->car->price) }} = £{{number_format($item->car->price * $item->order_quantity )}}</p>
                            @if($item->status == 'confirmed')<p> Order Status: Order Placed</p>
                            @elseif($item->status == 'processing')<p> Order Status: Preparing Order</p>
                            @elseif($item->status == 'shipped')<p> Order Status: Ready to Collect</p>
                            @elseif($item->status == 'delivered')<p> Order Status: Collected!</p>
                            @endif
                            <a href="{{ url('/carDetails/' . $item->car->id) }}">
                                <button type="submit" class="btn">View</button>
                            </a>
                            <a href="{{ url('/returnOne/' . $item->id) }}">
                                <button type="submit" class="btn">Return 1 {{$item->car->car_model}}</button>
                            </a>
                            @if(($item->order_quantity) > 1)
                                <a href="{{ url('/returnAll/' . $item->id) }}">
                                    <button type="submit" class="btn">Return {{$item->order_quantity}} {{$item->car->car_model}}</button>
                                </a>
                            @endif

                        </div>


                    </div>
                    <br><br>
                @endforeach
                <br><br>
                <h2>Total Price: £{{ number_format($subtotal, 2) }} </h2>

            </div>
        </div>
    </div>

</div>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
