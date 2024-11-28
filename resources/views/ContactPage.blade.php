<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="{{ asset("css/ContactPage.css") }}">
</head>
<header>
    <a href="{{ url("homepage.blade.php") }}">
        <img src="{{ asset("assets/BrumBrumm.png") }}" alt="image" width="150" height="100">
    </a>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <h2 id="carButtonNavBar">Cars</h2>
    <h1></h1>
    <h1></h1>
    <h2 id="contactButtonNavBar">Contact</h2>
    <h1></h1>
    <h1></h1>
    <h2 id="aboutButtonNavBar">About</h2>
    <br>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <img id="profileImage" src="{{ asset("assets/profile avatar neww.png") }}" alt="Profile Picture Image" width="75" height="75">
    <img id="basketImage" src="{{ asset("assets/basket avatar for nav bar.jpg") }}" alt="Basket Picture Image" width="75" height="75">
</header>
<body>
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
