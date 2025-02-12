 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/comparePage.css') }}">
    <title>Compare Cars</title>
</head>
<nav class="navbar">
    <div class="logo">BRUMBRUMM</div>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}" class="active">HOME</a></li>
        <li><a href="{{ url('/products') }}">PRODUCTS</a></li>
        <li><a href="{{ url('/aboutUs') }}">ABOUT US</a></li>
        <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
        <li><a href="{{ url('/basketPage') }}">BASKET</a></li>
        <li><a href="{{ url('/savedCars') }}">SAVED CARS</a></li>
    </ul>
</nav>


<body>
<h1 class="display-5 my-5 text-center">Compare Your Saved Vehicles</h1>

<div class="container">
    <div class="col-md-9 mx-auto">
        <form method="GET" action="{{ route('comparePage') }}">
            <table class="table">
                <tr class="bg-light">
                    <th>Select Product</th>
                    <th width="300px">
                        <select class="form-control" id="select1" name="car1_id" onchange="this.form.submit()">
                            <option value="0">-- Select Your Car --</option>
                            @foreach($savedCars as $savedCar)
                                <option value="{{ $savedCar->car->id }}" {{ request('car1_id') == $savedCar->car->id ? 'selected' : '' }}>
                                    {{ $savedCar->car->car_make }} {{ $savedCar->car->car_model }}
                                </option>
                            @endforeach
                        </select>
                    </th>
                    <th width="300px">
                        <select class="form-control" id="select2" name="car2_id" onchange="this.form.submit()">
                            <option value="0">-- Select Your Car --</option>
                            @foreach($savedCars as $savedCar)
                                <option value="{{ $savedCar->car->id }}" {{ request('car2_id') == $savedCar->car->id ? 'selected' : '' }}>
                                    {{ $savedCar->car->car_make }} {{ $savedCar->car->car_model }}
                                </option>
                            @endforeach
                        </select>
                    </th>
                </tr>

                @if($car1 && $car2)
                    <tr>
                        <th>Product Image</th>
                        <td>
                            <img src="{{ asset($car1->car_image) }}" alt="Car 1" width="150">
                        </td>
                        <td>
                            <img src="{{ asset($car2->car_image) }}" alt="Car 2" width="150">
                        </td>
                    </tr>
                    <tr>
                        <th>Car Price</th>
                        <td>£{{ $car1->price }}</td>
                        <td>£{{ $car2->price }}</td>
                    </tr>
                    <tr>
                        <th>Car Description</th>
                        <td>{{ $car1->car_description }}</td>
                        <td>{{ $car2->car_description }}</td>
                    </tr>
                    <tr>
                        <th>Car Brand</th>
                        <td>{{ $car1->car_make }}</td>
                        <td>{{ $car2->car_make }}</td>
                    </tr>
                    <tr>
                        <th>Car Mileage</th>
                        <td>{{ $car1->mileage }} mi</td>
                        <td>{{ $car2->mileage }} mi</td>
                    </tr>
                    <tr>
                        <th>Car Age</th>
                        <td>{{ $car1->year }} </td>
                        <td>{{ $car2->year }} </td>
                    </tr>
                    <tr>
                        <th>Transmission Type</th>
                        <td>{{ $car1->transmission }}</td>
                        <td>{{ $car2->transmission }}</td>
                    </tr>
                    <tr>
                        <th>Fuel Type</th>
                        <td>{{ $car1->fuel }}</td>
                        <td>{{ $car2->fuel }}</td>
                    </tr>
                @endif
            </table>
        </form>
    </div>
</div>

</body>

</html>


