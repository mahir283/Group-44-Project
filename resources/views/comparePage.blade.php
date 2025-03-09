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

<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>

<body>
<h1 class="display-5 my-5 text-center">Compare Your Saved Vehicles</h1>

<div class="container">
    <div class="col-md-9 mx-auto">
        <form method="GET" action="{{ route('comparePage') }}">
            <table class="table">
                <tr>
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
<br>
<br>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>


