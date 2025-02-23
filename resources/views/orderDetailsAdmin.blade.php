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
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
            <li><a href="{{ url('/basketPage') }}">Basket</a></li>
        </ul>

        @if (Auth::check())
            <form method="POST" action="{{ route('userLogout') }}">
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
                <img src="{{ asset('assets/' . $item->car->image) }}" alt="{{ $item->car->car_make }} {{ $item->car->car_model }}">
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
</html>
