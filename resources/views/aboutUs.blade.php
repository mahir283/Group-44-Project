<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BrumBrumm</title>
    <link rel="stylesheet" href="{{asset('css/aboutUs.css')}}">
</head>
<body>

<nav class="navbar">
    <div class="logo">BrumBrumm</div>
    <ul class="nav-links">
        <li><a href= "{{ url("/") }}" class="active" >Home</a></li>
        <li><a href="{{ url("/products") }}">Products</a></li>
        <li><a href="{{url("/aboutUs")}}">About Us</a></li>
        <li><a href="{{ url("/contact")}}">Contact Us</a></li>
        <li><a href="{{ url("/basketPage") }}">Basket</a></li>
    </ul>
    <div class="nav-buttons">
        <a href="#" class="btn sign-in">Sign In</a>
        <a href="#" class="btn register">Register</a>
    </div>
    <div class="loginSignupButtons">
        <a href="{{ url('/userLogin')  }}">
            <button id="loginButton">Login</button>
        </a>
        <a href="{{ url('/userRegister')  }}">
            <button id="registerButton">Register</button>
        </a>
    </div>
</nav>

<header class="hero-section">
    <div class="hero-overlay">
        <h1>About Us</h1>
        <p>Making car ownership accessible for everyone, from students to first-time buyers.</p>
    </div>
</header>

<section class="values-section">
    <div class="value-item">
        <h2>01. Affordable Prices</h2>
        <p>At BrumBrumm, we ensure our vehicles are priced competitively to suit every budget.</p>
    </div>
    <div class="value-item">
        <h2>02. Reliable Vehicles</h2>
        <p>Our cars undergo rigorous checks to guarantee reliability for years to come.</p>
    </div>
    <div class="value-item">
        <h2>03. Customer Satisfaction</h2>
        <p>We prioritize your needs, providing transparent services and excellent support.</p>
    </div>
    <div class="value-item">
        <h2>04. Community First</h2>
        <p>BrumBrumm empowers first-time drivers, students, and families with tailored solutions.</p>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
</footer>
</body>
</html>
