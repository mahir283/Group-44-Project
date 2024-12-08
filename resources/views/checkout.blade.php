<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

    <!-- Added this section, so we could distinguish the basket from the rest-->
    <style>
        .col ul li {
            color: white;
        }
        .col p {
            color: white;
        }
    </style>
</head>
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
        <div class="row">

            <!-- Billing Address Section -->
            <div class="col">
                <h3 class="title">Billing Address</h3>

                <div class="inputBox">
                    <span>Full Name :</span>
                    <input type="text" name="fullname" placeholder="Johnthan Newton" required>
                    @error('fullname')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" placeholder="john@outlook.com" required>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" name="first_line" placeholder="Location" required>
                    @error('first_line')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" name="city" placeholder="Birmingham" required>
                    @error('city')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Country :</span>
                        <input type="text" name="country" placeholder="United Kingdom" required>
                        @error('country')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <label for="postcode">Post Code:</label>
                        <input type="text" id="postcode" name="postcode" placeholder="AB1 2CD" required>
                        @error('postcode')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="col">
                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Name on Card :</span>
                    <input type="text" name="cardname" placeholder="Johnthan Newton" required>
                    @error('cardname')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>Credit Card Number :</span>
                    <input type="text" name="cardnumber" placeholder="1111-2222-3333-4444" pattern="\d{16}" required>
                    @error('cardnumber')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Expiry Month :</span>
                        <input type="number" name="expire_month" placeholder="MM" min="1" max="12" required>
                        @error('expire_month')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <span>Expiry Year :</span>
                        <input type="number" name="expire_year" placeholder="YYYY" min="2024" required>
                        @error('expire_year')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" name="cvv" placeholder="123" pattern="\d{3}" required>
                        @error('cvv')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Basket Summary -->
            <div class="col">
                <h3 class="title">Basket Summary</h3>
                <ul>
                    @foreach ($basketItems as $item)
                        <li>{{ $item->car->car_make }} {{$item->car->car_model}} - £{{ $item->car->price }} x {{ $item->quantity }}</li>
                    @endforeach
                </ul>
                <p><b>Total:</b> £{{ $subtotal }}</p>
            </div>
        </div>

        <input type="submit" value="Checkout">
    </form>

</div>
</body>
</html>
