<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Amendment</title>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
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

        <div class="user">
            <form class="details" action="">

                <label for="car"><strong>Username</strong></label>
                <input type="text" id="uName" name="user"><br>

                <label for="car"><strong>First Name</strong></label>
                <input type="text" id="fName" name="fname"><br>

                <label for="car"><strong>Last Name</strong></label>
                <input type="text" id="lName" name="lname"><br>

                <label for="car"><strong>Email</strong></label>
                <input type="email" id="email" name="email"><br>

                <label for="car"><strong>Phone Number</strong></label>
                <input type="text" id="phoNy" name="cars"><br>

                <!-- If unneeded delete-->

                <label for="car"><strong>Account Creation Date</strong></label>
                <input type="text" id="accountDate" name="accountDate"><br>

                <label for="car"><strong>Last Updated</strong></label>
                <input type="text" id="updateDate" name="updateDate"><br>

                <div class="updateButton">
                    <input id="submitButton" type = "submit" value = "Update"/>
                    <input type = "hidden" name = submitted" value = "true"/>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
