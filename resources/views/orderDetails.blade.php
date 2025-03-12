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
                            <p>Order Status: {{$item->status}} </p>
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
</html>
