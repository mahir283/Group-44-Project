<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
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
        <h1>Account</h1>

        <h2>User Information</h2>

        <div class="details">
            <strong>Username</strong><p><!-- uname--></p>
            <strong>First Name</strong><p><!-- fname--></p>
            <strong>Last Name</strong><p><!-- lname--></p>
            <strong>Email</strong><p><!-- email --></p>
            <strong>Phone Number</strong><p><!-- phonenumber--></p>

            <!-- Delete if this section is not needed -->
            <strong>User Type</strong><p><!-- usertype--></p>
            <strong>Account Creation Date</strong><p><!-- account creation date--></p>
            <strong>Account Update Date</strong><p><!-- account update date--></p>
        </div>

            <form class="settingsButton" action="">
                <input id="submitButton" type = "submit" value = "Account Settings"/>
                <input type = "hidden" name = submitted" value = "true"/>
            </form>

    </div>
</div>

</body>
</html>
