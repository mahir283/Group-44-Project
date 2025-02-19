<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>

    <link rel="stylesheet" href="{{ asset('css/prAmendment.css') }}">
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

<!-- Form: allowing for displaying of product details to add them-->
<div class="details">
    <div class="detailsContainer">
        <h1>Add Product</h1>

        <h2>Details</h2>

        <div class="products">
            <form class="productDetails" action="">
                <label for="car"><strong>Car</strong></label>
                <input type="text" id="car" name="cars"><br>

                <label for="carModel"><strong>Car Model</strong></label>
                <input type="text" id="carModel" name="carModel"><br>

                <label for="description"><strong>Description</strong></label>
                <input type="text" id="description" name="description"><br>

                <label for="quantity"><strong>Quantity</strong></label>
                <input type="text" id="quality" name="quality"><br>

                <label for="price"><strong>price</strong></label>
                <input type="text" id="price" name="price" prefix=""><br>

                <label for="colour"><strong>Colour</strong></label>
                <input type="text" id="colour" name="colour"><br>

                <label for="year"><strong>Year</strong></label>
                <input type="text" id="year" name="year"><br>

                <label for="mileage"><strong>Mileage</strong></label>
                <input type="text" id="mileage" name="mileage"><br>

                <label for="Fuel"><strong>Fuel</strong></label>
                <select id="cars" name="cars">
                    <option value="petrol">Petrol</option>
                    <option value="diesel">Diesel</option>
                </select><br>

                <label for="transmission"><strong>Transmission</strong></label>
                <select id="cars" name="cars">
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select><br>

                <label for="Category"><strong>Category</strong></label>
                <select id="cars" name="cars">
                    <option value="suv">SUV</option>
                    <option value="coupe">Coupe</option>
                    <option value="saloon">Saloon</option>
                    <option value="van">Van</option>
                    <option value="hatchback">Hatchback</option>
                </select><br>

                <label for="image"><strong>Image</strong></label>
                <input type="file" id="imgFile" name="imgFile"><br>
                <img src="" id="image" alt="" width="100" height="100">

                <br>
                <input id="submit" type = "submit" value = "Confirm"/>
                <input type = "hidden" name = submitted" value = "true"/>
            </form>
        </div>

    </div>
</div>

</body>
</html>
