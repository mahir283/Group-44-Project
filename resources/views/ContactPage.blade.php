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
            <li><a href="{{ url('/') }}" class="active">Home</a></li>
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/aboutUs') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
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

<body>
<h1>Contact Us</h1>
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
</html>
