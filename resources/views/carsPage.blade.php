<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="{{ asset('css/productsPage.css') }}">
</head>
<body>
    <!-- Navigation bar-->


    <!-- Navbar for searching -->
    <div class="searchNav">
        <form action="{{ url()->current() }}" method="GET" class="searchBar">
            <input type="text" placeholder="Search Cars..">
            <button type="submit">Go</button>
        </form>
    </div>

    <!-- NavBar for Filtering-->
    <div class="filter">
        <ul>
            <li><a href="{{ url('/products?category=suv') }}">SUV</a></li>
            <li><a href="{{ url('/products?category=saloon') }}">Saloon</a></li>
            <li><a href="{{ url('/products?category=hatchback') }}">Hatchback</a></li>
            <li><a href="{{ url('/products?category=coupe') }}">Coupe</a></li>
            <li><a href="{{ url('/products?category=van') }}">Van</a></li>
        </ul>
    </div>

    <!-- Products Displayed -->
    <div class="row">
        @foreach($cars as $car)
        <div class="column">
            <img src="{{ asset($car->car_image) }}" style="width: 350px; height: 350px;" alt="car">
            <h1>{{ $car->car_make }} {{$car->car_model}}</h1>

            <p>IN-STOCK: {{ $car->quantity }}</p>
            <p class="price">£{{ $car->price }}</p>
            <p>
                <a href="{{ url('/carDetails/' . $car->id) }}">
                    <button>VIEW</button>
                </a>
            </p>
            <p><button>Add to Basket</button></p>
        </div>
        @endforeach
    </div>

</body>
</html>
