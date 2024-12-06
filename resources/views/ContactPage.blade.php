<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="{{ asset("css/ContactPage.css") }}">
</head>
<header>
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
    </nav>
</header>
<body>

<form action = "{{route('contact.submit') }}" method = "post">
    @csrf
    <div>
        <label>First Name</label>
        <input type = "text" id = "FirstName" name = "FirstName" placeholder = "First Name" required>
        <label>Last Name</label>
        <input type = "text" id = "LastName" name = "LastName" placeholder = "Last Name" required>
    </div>
    <br>
    <div>
        <label>Email</label>
        <input type = "email" id = "Email" name = "Email" placeholder = "Email" required>
    </div>
    <br>
    <div>

        <label>Phone</label>
        <input type = "tel" id = "PhoneNumber" name = "PhoneNumber" placeholder = "Phone Number" required>
    </div>
    <br>
    <div>
        <label>Query</label>
        <input type = "text" id = "Query" name = "Query" placeholder = "Enter Your Query" required>
    </div>
    <br>
    <div>
        <input type = "submit">
    </div>
</form>
<div class="contact">
    <img id="BrumBrumm" src="{{ asset("assets/BrumBrumm-Photoroom.png") }}" alt="Logo on Contact Page" height="400" width="450">
    <p id="Mahir">Mahir Afaq</p>
    <p id="MahirEmail">email:123fake@gmail.com</p>
    <p id="MahirNumber">number: 098765432198</p>
    <br>
    <p id="Allen">Allen Vasanth</p>
    <p id="AllenEmail">123fake@gmail.com</p>
    <p id="AllenNumber">number: 098765432198</p>
</div>
</body>
</html>
