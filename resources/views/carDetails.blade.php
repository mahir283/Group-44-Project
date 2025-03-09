<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="{{ asset('css/car-details.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
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
        <p><strong>Price:</strong> £{{ number_format($car->price, 2) }}</p>

        <p>
            <strong>Stock:</strong>
            @if($car->quantity > 0)
                {{ $car->quantity }}
            @else
                <span style="color: red; font-weight: bold;">OUT OF STOCK</span>
            @endif
        </p>

        <p><strong>Description:</strong></p>
        <p>{{ $car->car_description }}</p>

        <!-- Add to Basket Form (Only if in stock) -->
        @if($car->quantity > 0)
            <form action="{{ route('basket.add') }}" method="POST">
                @csrf
                <input type="hidden" name="car" value="{{ $car->id }}">
                <button type="submit" class="add-to-basket-btn">Add to Basket</button>
            </form>
        @endif

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
<script src="{{ asset('js/darkmode.js') }}"></script>
</body>
</html>
