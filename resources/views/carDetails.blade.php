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
    <p><strong>Description: {{$car->car_description}}</strong>         </p>
    <p><strong>Year: {{$car->year}}</strong>           </p>
    <p><strong> Colour: {{$car->colour}} </strong>       </p>
    <p><strong>Mileage: {{$car->mileage}} </strong>       </p>
    <p><strong>Fuel: {{$car->fuel}} </strong>          </p>
    <p><strong>Transmission: {{$car->transmission}} </strong>  </p>
    <p><strong>Price: {{$car->price}} </strong>         </p>


</div>

<div class="back-button">
    <a href="{{url("/products")}}" class="backbtn">Back</a>
</div>

    <div class="add-to-basket-button">
        <a href="/" class="basketbtn">Add to Basket</a>
    </div>
</div>

</body>
