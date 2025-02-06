<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="{{ asset('css/car-details.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="car-details-container">
    <!-- Car details section -->
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

        <!-- Add to Basket Form -->
        <form action="{{ route('basket.add') }}" method="POST">
            @csrf
            <input type="hidden" name="car" value="{{ $car->id }}">
            <button type="submit" class="add-to-basket-btn">Add to Basket</button>
        </form>

        <!-- Back to Products Link -->
        <a href="{{ url('/products') }}" class="back-btn">Back to Products</a>
    </div>
</div>

<!-- Review Section -->
<div class="review-section">
    <h3>Leave a Review</h3>

    <!-- Review Form (for authenticated users) -->
    @auth
        <form action="{{ route('car.review.store', ['car_id' => $car->id]) }}" method="POST">
            @csrf
            <div class="rating">
                <label for="rating">Rating: </label>
                <span class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="{{ $i }}-stars">
                        <label for="{{ $i }}-stars">★</label>
                    @endfor
                </span>
            </div>
            <textarea name="comment" placeholder="Write your comment here..." rows="4" required></textarea>
            <button type="submit" class="submit-btn">Submit Review</button>
        </form>
    @else
        <!-- Message for unauthenticated users -->
        <p>You must <a href="{{ route('userLogin') }}">log in</a> to leave a review.</p>
    @endauth

    <!-- Previous Reviews Section -->
    <div class="comments">
        <h4>Previous Reviews</h4>
        @if ($reviews->isEmpty())
            <p>No reviews yet. Be the first to leave a review!</p>
        @else
            @foreach ($reviews as $review)
                <div class="comment">
                    <div class="comment-user">
                        {{ $review->user->username }} <!-- Display the username -->
                        <span class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </span>
                    </div>
                    <p>{{ $review->review }}</p>
                    <small>{{ $review->created_at->format('M d, Y H:i') }}</small>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- JavaScript for Star Rating UI -->
<script src="{{ asset('js/carDetails.js') }}"></script>
</body>
</html>
