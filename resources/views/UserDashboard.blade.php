<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
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

    <div class="dashboard-container">
        @if (Auth::check())
            <h1>Welcome to Your Dashboard, {{ Auth::user()->username }}</h1>
            <div class="user-info">
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Joined on:</strong> {{ Auth::user()->created_at }}</p>
            </div>

            <div class="user-actions">
                <a href="{{ url('/profile') }}" class="btn">Saved Cars</a>
                <a href="{{ url('/edit-profile') }}" class="btn">Edit Profile</a>
                <a href="{{ url('/previous-orders') }}" class="btn">View Orders</a> <!-- Updated link -->
            </div>
        @else
            <p>Please login to access your dashboard.</p>
        @endif
    </div>

    <footer class="footer">
        <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
    </footer>
</div>

<script src="{{ asset('js/darkmode.js') }}"></script>

</body>
</html>
