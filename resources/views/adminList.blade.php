<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="{{ asset('css/adminList.css') }}">
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<body>
@if(Auth::check() && Auth::user()->user_type == 'admin')

<main class="table" id="customers_table">
    <section class="table__header">
        <h1> Admin Orders</h1>
    </section>

    <section class="status-message">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </section>

    <form method="GET" action=" {{route('admin.orders')}}" class="search-container">
        <input class = "search-bar" type="text" name="search" value="{{request('search')}}" placeholder="Search by Name or Order Number...">
        <button class = "search-button" type="submit">Search</button>
    </form>

    <section class="table__body">
        <table>
            <thead>
            <tr>
                <th> Order Number </th>
                <th> Customer Name </th>
                <th> Order Date </th>
                <th> Order Status </th>
                <th> Order Amount </th>
                <th> Order Price</th>
                <th> Actions</th>
                <th> Delete </th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order['order_number'] }}</td>
                    <td>{{ $order['customer_name'] }}</td>
                    <td>{{ $order['order_date'] }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order['order_number'] }}">
                            <select class = "orderStatusDropdown" name="status" onchange="this.form.submit()">
                                <option value="confirmed" {{ strtolower($order['order_status']) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="shipped" {{ strtolower($order['order_status']) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ strtolower($order['order_status']) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="processing" {{ strtolower($order['order_status']) == 'processing' ? 'selected' : '' }}>Processing</option>
                            </select>
                        </form>
                    </td>
                    <td><strong>{{ $order['number_of_items'] }}</strong></td>
                    <td><strong>${{ number_format($order['order_price'], 2) }}</strong></td>
                    <td>
                        <a href="{{ route('admin.order.details', ['orderId' => $order['order_number']]) }}" class="view-btn">View</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="order_id" value="{{ $order['order_number'] }}">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</main>
@endif
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>

</html>
