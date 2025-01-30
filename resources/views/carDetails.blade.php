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

        <div class="car-image">
            <img src="{{ asset($car->car_image) }}" alt="carImage">
        </div>

        <div class="car-info">

            <h2 id="car-title">{{$car->car_make}} {{$car->car_model}} </h2>
            <br><br>

            <p><strong>Year</strong> | <strong>Colour</strong> | <strong>Mileage</strong></p>
            <p>{{ $car->year }} | {{ $car->colour }} | {{ $car->mileage }}</p>
            <br>

            <p><strong>Fuel</strong> | <strong>Transmission</strong></p>
            <p>{{ $car->fuel }} | {{ $car->transmission }}</p>
            <br>

            <p><strong>Price</strong></p>
            <p>£{{ $car->price }}</p>
            <br><br>

            <p><strong>Description</strong></p>
            <p>{{ $car->car_description }}</p>

        </div>

        <!-- Updated Add to Basket Button -->
        <div class="add-to-basket-button">
            <form action="{{ route('basket.add') }}" method="POST">
                @csrf
                <input type="hidden" name="car" value="{{ $car->id }}">
                <button type="submit" class="basketbtn">Add to Basket</button>
            </form>
        </div>

        <div class="back-button">
            <a href="{{ url('/products') }}" class="backbtn">Back</a>
        </div>
    </div>

    <br>

    <!-- Comment/Review section-->
    <form action="" class="comment">
        <h2>Comments</h2>

        <br><br>

        <div class="user">
            <div class="profile-image">

            </div>
            <div class="profile-name">
                <p>Jane Doe</p> <!-- Placeholder-->
            </div>

        </div>

        <input type="text" id="comment-box" name="comment-box" placeholder="Add a comment">
        <br>
        <button class="comment-button">Comment</button>
    </form>

</body>
</html>
