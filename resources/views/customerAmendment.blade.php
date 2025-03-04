<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Amendment</title>
    <link rel="stylesheet" href="{{ asset('css/customerAmendment.css') }}">
</head>
<body>
<div class="homepageDiv">
    <header>
        <nav class="navbar">
            <div class="logo">BRUMBRUMM</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="active">HOME</a></li>
                <li><a href="{{ url('/products') }}">PRODUCTS</a></li>
                <li><a href="{{ url('/aboutUs') }}">ABOUT US</a></li>
                <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
                <li><a href="{{ url('/basketPage') }}">BASKET</a></li>
            </ul>
            <div class="nav-buttons">
                @if (Auth::check())
                    <form method="POST" action="{{ route('userLogout') }}">
                        @csrf
                        <button id="loginButton">LOGOUT</button>
                    </form>
                @else
                    <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                    <a href="{{ url('registerUser') }}" class="btn register">Register</a>
                @endif
            </div>
        </nav>
    </header>
</div>

<!-- Displaying Details -->
<div class="userDetails">
    <div class="detailsContainer">
        <h1>Customer Amendment</h1>
        <h2>User Information</h2>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="user">
            <form class="details" action="{{ route('customer.amendments.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="username"><strong>Username</strong></label>
                <input type="text" id="uName" name="username" value="{{ $customer->username }}"><br>

                <label for="first_name"><strong>First Name</strong></label>
                <input type="text" id="fName" name="first_name" value="{{ $customer->first_name }}"><br>

                <label for="last_name"><strong>Last Name</strong></label>
                <input type="text" id="lName" name="last_name" value="{{ $customer->last_name }}"><br>

                <label for="email"><strong>Email</strong></label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}"><br>

                <label for="phone_number"><strong>Phone Number</strong></label>
                <input type="text" id="phoNy" name="phone_number" value="{{ $customer->phone_number }}"><br>

                <!-- Uneditable Fields -->
                <label for="accountDate"><strong>Account Creation Date</strong></label>
                <input type="text" id="accountDate" name="accountDate" value="{{ $customer->created_at }}" readonly><br>

                <label for="updateDate"><strong>Last Updated</strong></label>
                <input type="text" id="updateDate" name="updateDate" value="{{ $customer->updated_at }}" readonly><br>

                <div class="updateButton">
                    <input id="submitButton" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
