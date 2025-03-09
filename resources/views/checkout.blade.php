<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<body>
<div class="container">
    <!-- Display success or error message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1>Checkout</h1>

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf
        <div class="checkout-sections">
            <!-- Billing Address Section -->
            <div class="card billing-container" id="card1">
                <h3 class="title">Billing Address</h3>

                <div class="inputBox">
                    <span>Full Name:</span>
                    <input type="text" name="fullname" placeholder="Johnthan Newton" required>
                    @error('fullname')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Email:</span>
                    <input type="email" name="email" placeholder="john@outlook.com" required>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Address:</span>
                    <input type="text" name="first_line" placeholder="Location" required>
                    @error('first_line')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>City:</span>
                    <input type="text" name="city" placeholder="Birmingham" required>
                    @error('city')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Country:</span>
                        <input type="text" name="country" placeholder="United Kingdom" required>
                        @error('country')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <span>Post Code:</span>
                        <input type="text" id="postcode" name="postcode" placeholder="AB1 2CD" required>
                        @error('postcode')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="card payment-container" id="card2">
                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Name on Card:</span>
                    <input type="text" name="cardname" placeholder="Johnthan Newton" required>
                    @error('cardname')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Credit Card Number:</span>
                    <input type="text" name="cardnumber" placeholder="1111-2222-3333-4444" pattern="\d{16}" required>
                    @error('cardnumber')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Expiry Month:</span>
                        <input type="number" name="expire_month" placeholder="MM" min="1" max="12" required>
                        @error('expire_month')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <span>Expiry Year:</span>
                        <input type="number" name="expire_year" placeholder="YYYY" min="2024" required>
                        @error('expire_year')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <span>CVV:</span>
                        <input type="text" name="cvv" placeholder="123" pattern="\d{3}" required>
                        @error('cvv')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Basket Summary -->
            <div class="card basket-summary" id="card3">
                <h3 class="title">Basket Summary</h3>
                <ul>
                    @foreach ($basketItems as $item)
                        <li>{{ $item->car->car_make }} {{$item->car->car_model}} - £{{ $item->car->price }} x {{ $item->quantity }}</li>
                    @endforeach
                </ul>
                <p style="margin-top: 10px;"><b>Total:</b> £{{ $subtotal }}</p>

                <!-- Checkout Button -->
                <input type="submit" class="checkout-button" value="Checkout" />

            </div>
        </div>
    </form>
</div>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>

