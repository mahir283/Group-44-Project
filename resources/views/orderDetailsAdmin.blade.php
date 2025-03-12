<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/orderDetailsAdmin.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<main>
    <div class="orderStatus">
        <h2>Order #{{ $order->id }}</h2>
        <label for="orderStatusDropDown">Order Status: </label>
        <select id="orderStatusDropDown" name="orderStatusDropDown">
            <option value="orderPlaced" {{ $order->orderedItems->first()->status == 'orderPlaced' ? 'selected' : '' }}>Order Placed</option>
            <option value="processing" {{ $order->orderedItems->first()->status == 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ $order->orderedItems->first()->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ $order->orderedItems->first()->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
        <p>Total Amount: £{{ number_format($order->orderedItems->sum(function ($item) {
            return $item->order_quantity * $item->car->price;
        }), 2) }}</p>
        <button id="removeOrderButton" class="removeOrderButton">Remove Order</button>
    </div>
    <div class="orderedCars">
        @foreach ($order->orderedItems as $item)
            <div class="eachOrderedCar">
                <img src="{{ asset($item->car->car_image) }}" alt="{{ $item->car->car_make }} {{ $item->car->car_model }}">
                <div class="eachOrderedCarInfo">
                    <p>Make: {{ $item->car->car_make }}</p>
                    <p>Model: {{ $item->car->car_model }}</p>
                    <p>Year: {{ $item->car->year }}</p>
                    <p>Colour: {{ $item->car->colour }}</p>
                    <p>Amount: £{{ number_format($item->order_quantity * $item->car->price, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</main>
<script>
    $(document).ready(function () {
        // Update order status
        $('#orderStatusDropDown').change(function () {
            const orderId = {{ $order->id }};
            const status = $(this).val();

            $.ajax({
                url: "{{ route('updateOrderStatus', ['orderId' => $order->id]) }}",
                method: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });

        // Remove order
        $('#removeOrderButton').click(function () {
            if (confirm('Are you sure you want to remove this order?')) {
                const orderId = {{ $order->id }};

                $.ajax({
                    url: "{{ route('removeOrder', ['orderId' => $order->id]) }}",
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert(response.message);
                        window.location.href = "{{ route('admin.orders') }}";
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON.error);
                    }
                });
            }
        });
    });
</script>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
