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
        <h2>{{ $car->car_make }} {{ $car->car_model }}</h2>
        <p><strong>Year:</strong> {{ $car->year }} | <strong>Colour:</strong> {{ $car->colour }} | <strong>Mileage:</strong> {{ $car->mileage }} miles</p>
        <p><strong>Fuel:</strong> {{ $car->fuel }} | <strong>Transmission:</strong> {{ $car->transmission }}</p>
        <p><strong>Price:</strong> £{{ $car->price }}</p>
        <p><strong>Description:</strong></p>
        <p>{{ $car->car_description }}</p>


        <form action="{{ route('basket.add') }}" method="POST">
            @csrf
            <input type="hidden" name="car" value="{{ $car->id }}">
            <button type="submit" class="add-to-basket-btn">Add to Basket</button>
        </form>

        <!-- Back to Products Button -->
        <a href="{{ url('/products') }}" class="back-btn">Back to Products</a>
    </div>

</div>


<div class="review-section">
    <h3>Leave a Review</h3>
    <form action="" method="POST">
        <div class="rating">
            <label for="rating">Rating: </label>
            <span class="star-rating">
                    <input type="radio" name="rating" value="5" id="5-stars"><label for="5-stars">★</label>
                    <input type="radio" name="rating" value="4" id="4-stars"><label for="4-stars">★</label>
                    <input type="radio" name="rating" value="3" id="3-stars"><label for="3-stars">★</label>
                    <input type="radio" name="rating" value="2" id="2-stars"><label for="2-stars">★</label>
                    <input type="radio" name="rating" value="1" id="1-star"><label for="1-star">★</label>
                </span>
        </div>
        <textarea name="comment" placeholder="Write your comment here..." rows="4"></textarea>
        <button type="submit" class="submit-btn">Submit Review</button>
    </form>


    <div class="comments">
        <h4>Previous Reviews</h4>
        <div class="comment">
            <div class="comment-user">Jane Doe <span class="star-rating">★★★★☆</span></div>
            <p>"Great car, loved it! Definitely worth the price."</p>
        </div>
        <div class="comment">
            <div class="comment-user">John Smith <span class="star-rating">★★★☆☆</span></div>
            <p>"It was good but a little pricey for the mileage."</p>
        </div>
    </div>
</div>

</body>
</html>
