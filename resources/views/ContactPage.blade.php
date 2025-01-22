<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="{{ asset('css/ContactPage.css') }}">
</head>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}" class="active">Contact Us</a></li>
            <li><a href="{{ url('/basketPage') }}">Basket</a></li>
        </ul>

        @if (Auth::check())
            <form method="POST" action="{{ route('userLogout') }}">
                @csrf
                <button id="loginButton">Logout</button>
            </form>
        @else
            <div class="nav-buttons">
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
            </div>
        @endif
    </nav>
</header>

<button id="theme-switch">
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>


</button>

<body>
<h1>Contact Us</h1>
@if(session('success'))
    <div class="alert-success">
        <h2>{{ session('success') }}</h2>
    </div>
@endif
<h3>If you have any further questions or inquiries, please don't hesitate to fill out the contact form and we will get back to you as soon as possible.</h3>
<!-- Contact Form Section -->
<form class = "contactForm" action="{{ route('contact.submit') }}" method="post" class="contact-form">
    @csrf
    <div>
        <label for="FirstName">First Name</label>
        <input type="text" id="FirstName" name="FirstName" placeholder="First Name" required>
    </div>
    <br>
    <div>
        <label for="LastName">Last Name</label>
        <input type="text" id="LastName" name="LastName" placeholder="Last Name" required>
    </div>
    <br>
    <div>
        <label for="Email">Email</label>
        <input type="email" id="Email" name="Email" placeholder="Email" required>
    </div>
    <br>
    <div>
        <label for="PhoneNumber">Phone</label>
        <input type="tel" id="PhoneNumber" name="PhoneNumber" placeholder="Phone Number" required>
    </div>
    <br>
    <div>
        <label for="Query">Query</label>
        <input type="text" id="Query" name="Query" placeholder="Enter Your Query" required>
    </div>
    <br>
    <div>
        <input type="submit" value="Submit">
    </div>
</form>

<!-- Contact Information Section -->
<div class="contact-info">
    <h3>For more assistance, feel free to reach out to our team:</h3>
    <h3><strong>Mahir Afaq</strong><br>Email: <a href="mailto:123fake@gmail.com">123fake@gmail.com</a><br>Phone: 098765432198</h3>
    <h3><strong>Allen Vasanth</strong><br>Email: <a href="mailto:123fake@gmail.com">123fake@gmail.com</a><br>Phone: 098765432198</h3>
</div>

</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
