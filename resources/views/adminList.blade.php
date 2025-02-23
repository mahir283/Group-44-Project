<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="{{ asset('css/adminList.css') }}">
</head>

<body>
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
                            <select name="status" onchange="this.form.submit()">
                                <option value="confirmed" {{ strtolower($order['order_status']) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="shipped" {{ strtolower($order['order_status']) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ strtolower($order['order_status']) == 'delivered' ? 'selected' : '' }}>Delivered</option>
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

</body>

</html>
