<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amendments</title>

    <link rel="stylesheet" href="{{ asset('css/prAmendment.css') }}">
</head>
<body>

<div class="homepageDiv">

    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo">BrumBrumm</div>
            <ul class="nav-links">
                <li><a href= "{{ url("/") }}">Home</a></li>
                <li><a href="{{ url("/products") }}" class="active" >Products</a></li>
                <li><a href="{{url("/aboutUs")}}">About Us</a></li>
                <li><a href="{{ url("/contact")}}">Contact Us</a></li>
                <li><a href="{{ url("/basketPage") }}">Basket</a></li>
            </ul>

            <div class="nav-buttons">
                @if (Auth::check())
                    @if(Auth::User()->user_type == 'customer')
                        <a href = "{{url('dashboard')}}" class="btn">Dashboard</a>
                    @else
                        <a href = "{{url('admin')}}" class="btn">Dashboard</a>
                    @endif
                    <form method="POST" action = "{{route('userLogout')}}">
                        @csrf
                        <button id="loginButton" class = "btn">Logout</button>
                    </form>

                @else
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
</div>

<!-- Form: allowing for displaying of product details-->
<div class="details">
    <div class="detailsContainer">
        <h1>Add Product</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Ensure all fields are filled</h2>

        <div class="products">
            <form class="productDetails" method = "POST" action="{{route('submitAddCar')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id = "carId" name="carId" >

                <label for="carMake"><strong>Car Make</strong></label>
                <input type="text" id="carMake" name="carMake"  pattern="^(?!\s*$).+" title="This field must not be empty or just whitespace" required><br>

                <label for="carModel"><strong>Car Model</strong></label>
                <input type="text" id="carModel" name="carModel"  pattern="^(?!\s*$).+" title="This field must not be empty or just whitespace" required><br>

                <label for="description"><strong>Description</strong></label>
                <input type="text" id="description" name="description"  pattern="^(?!\s*$).+" title="This field must not be empty or just whitespace" required ><br>

                <label for="quantity"><strong>Quantity</strong></label>
                <input type="number" id="quantity" name="quantity"  required><br>

                <label for="price"><strong>Price</strong></label>
                <input type="number" id="price" name="price"  required><br>

                <label for="colour"><strong>Colour</strong></label>
                <input type="text" id="colour" name="colour"  pattern="^(?!\s*$).+" title="This field must not be empty or just whitespace" required><br>

                <label for="year"><strong>Year</strong></label>
                <input type="number" id="year" name="year"  required><br>

                <label for="mileage"><strong>Mileage</strong></label>
                <input type="number" id="mileage" name="mileage" value =  required><br>

                <label for="Fuel"><strong>Fuel</strong></label>
                <select id="cars" name="fuel">
                    <option value="petrol">Petrol</option>
                    <option value="diesel">Diesel</option>
                </select><br>

                <label for="transmission"><strong>Transmission</strong></label>
                <select id="cars" name="transmission">
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select><br>

                <label for="Category"><strong>Category</strong></label>
                <select id="cars" name="category">
                    <option value="SUV">SUV</option>
                    <option value="Coupe">Coupe</option>
                    <option value="Saloon">Saloon</option>
                    <option value="Van">Van</option>
                    <option value="Hatchback" >Hatchback</option>
                </select><br>

                <label for="carImage"><strong>Image</strong></label>
                <input type="file" name="carImage" id="carImage" accept=".jpg,.jpeg,.png" required>
                <p id="error-message" style="color: red;"></p>

                <script>
                    document.getElementById("carImage").addEventListener("change", function() {
                        var file = this.files[0];
                        if (file) {
                            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                            if (!allowedExtensions.test(file.name)) {
                                document.getElementById("error-message").textContent = "Invalid file type. Please upload a JPG, JPEG or PNG image.";
                                this.value = ""; // Clear the file input
                            } else {
                                document.getElementById("error-message").textContent = "";
                            }
                        }
                    });
                </script>

                <br>
                <input type = "hidden" name = submitted" value = "true"/>
                <input id="submit" type = "submit"/>

            </form>
        </div>

    </div>
</div>

</body>
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <ul>
                <li><a href="https://www.instagram.com"><img src ="{{asset("assets/insta (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://www.facebook.com"><img src = "{{asset("assets/facebook (1).png")}}" height = "27" width = "27"></a></li>
                <li><a href="https://x.com/?lang=en"><img src = "{{asset("assets/X (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://telegram.org"><img src = "{{asset("assets/telegram (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://uk.linkedin.com"><img src = "{{asset("assets/linkedin (1).png")}}" height = "25" width = "25"></a></li>
            </ul>
        </div>
        <div class="footer-center">
            <h1>brumbrumm</h1>
            <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
        </div>
        <div class="footer-right">
            <p>Email: BrumBrummManagement@gmail.com</p>
            <p>Phone: +44 7847357490</p>
        </div>
    </div>
</footer>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
