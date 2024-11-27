<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrumBrumm</title>
    <link rel="stylesheet" href="{{ asset ("/homepage.css") }}">
</head>
<header>

    <a href="{{ url("homepage.html") }}">
        <img src="{{ asset("/BrumBrumm.png") }}" alt="image" width="150" height="100">
    </a>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <h2 id="carButtonNavBar">Cars</h2>
    <h1></h1>
    <h1></h1>
    <a href="{{ url("ContactPage.html") }}"><h2 id="contactButtonNavBar">Contact</h2></a>
    <h1></h1>
    <h1></h1>
    <h2 id="aboutButtonNavBar">About</h2>
    <br>
    <h1></h1>
    <h1></h1>
    <h1></h1>
    <img id="profileImage" src="{{ asset("/profile avatar neww.png") }}" alt="Profile Picture Image" width="75" height="75">
    <img id="basketImage" src="{{ asset("/basket avatar for nav bar.jpg") }}" alt="Basket Picture Image" width="75" height="75">
</header>

<div>
    <img id="BlackSuzuki" src="{{ asset("/black Suzuki Swift-Photoroom.png") }}" alt="Black Suzuki Homepage" height="400" width="600">
    <img id="BrumBrummBetweenBlackRedCars" src="{{ asset("/BrumBrumm-Photoroom.png") }}" alt="BrummBrumm Logo between the 2 cars at the homepage" height="250" width="250">
    <img id="RedMerc" src="{{ asset("/RedMerc-Photoroom.png") }}" alt="Red Mercedes Homepage" height="400" width="600">
</div>
<br>
<div class="SloganHomePage">
    <p id="YourTimeIsValuable">YOUR TIME IS VALUABLE</p>
    <p id="FindYourDesiredVehicleOnline">FIND YOUR DESIRED VEHICLE <span id="OnlineWord">ONLINE</span></p>
    <p id="AndSkipTheWaitAtTheDealership">AND SKIP THE WAIT AT THE DEALERSHIP</p>
</div>

<div class="ColourSectionHomePage">
    <h2 id="VERYFAST">VERY FAST <span id="VERYSIMPLE">VERY SIMPLE</span></h2>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
<br>
<br>
<main>
    <div>
        <h1 id="FindYourBrumBrumm">FIND YOUR BRUMBRUMM!</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div>
        <img id="AudiA42008" src="{{ asset("/audi a4 2008.jpeg") }}" alt="Audi A4 on Homepage">
        <img id="FordKa2003" src="{{ asset("/ford ka 2003.jpeg") }}" alt="Ford Ka on Homepage">
        <img id="Yaris2002" src="{{ asset("/toyota yaris 2002.jpeg") }}" alt="Toyota Yaris on Homepage">
    </div>
    <br>
    <div class="CheckOutMoreButtonContainer">
        <button id="CheckOutMoreButton">CHECK OUT MORE</button>
    </div>

</main>
</html>
