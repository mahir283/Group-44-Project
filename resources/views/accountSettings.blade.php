<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    <link rel="stylesheet" href="{{ asset('css/accountSettings.css') }}">
</head>
<body>

    <div class="homepageDiv">

        <!-- Navbar -->
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
                </div>
                @endif
            </nav>
        </header>
    </div>

    <!-- Details form: holding the user details-->


</body>
</html>
