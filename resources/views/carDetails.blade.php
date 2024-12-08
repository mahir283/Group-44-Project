<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="{{ asset('css/car-details.css') }}">
</head>
<body>
<div class="car-details-container">
<h2>Car Details: {{$car->car_make}} {{$car->car_model}} </h2>

<div class="car-image">
    <img src="{{asset($car->car_image)}}" alt="carImage" >
</div>

<div class="car-info">
    <p><strong>Description: </strong> </p>
    <p>{{$car->car_description}}</p>
    <br>
    <p><strong>Year: </strong>{{$car->year}} | <strong> Colour: </strong>{{$car->colour}} | <strong>Mileage: </strong>{{$car->mileage}}</p>
    <p><strong>Fuel: </strong>{{$car->fuel}} | <strong>Transmission: </strong>{{$car->transmission}}</p>
    <p><strong>Price: </strong>£{{$car->price}}</p>


</div>
    <div class="add-to-basket-button">
        <a href="/" class="basketbtn">Add to Basket</a>
    </div>
<div class="back-button">
    <a href="{{url("/products")}}" class="backbtn">Back</a>
</div>


</div>

</body>
