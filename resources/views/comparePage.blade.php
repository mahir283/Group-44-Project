
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/comparePage.css')}}">

    <title>Compare Cars</title>
</head>

<nav class="navbar">
    <div class="logo">BRUMBRUMM</div>
    <ul class="nav-links">
        <li><a href="{{ url('/') }}" class="active">HOME</a></li>
        <li><a href="{{ url('/products') }}">PRODUCTS</a></li>
        <li><a href="{{ url('/aboutUs') }}">ABOUT US</a></li>
        <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
        <li><a href="{{ url('/basketPage') }}">BASKET</a></li>
    </ul>

</nav>

<body>

<h1 class="display-5 my-5 text-center">Compare and find the right car for you</h1>
<div class="container">
    <div class="col-md-9 mx-auto">
        <table class="table">
            <tr class="bg-light">
                <th>Select Product</th>
                <th width="300px">
                    <select class="form-control" id="select1" onchange="item1(this.value)">
                        <option value="0">-- Select Your Car --</option>
                    </select>
                </th>
                <th width="300px">
                    <select class="form-control" id="select2" onchange="item2(this.value)">
                        <option value="0">-- Select Your Car --</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Product Image</th>
                <td>
                    <img src="{{asset('assets/toyota yaris 2002.jpeg')}}"
                         id="img1" alt=" Car ">
                </td>
                <td>
                    <img src={{asset('assets/yaris.png')}}
                         id="img2" alt=" CAR ">
                </td>
            </tr>
            <tr>
                <th>Car Price</th>
                <td id="price1">5 MILLION</td>
                <td id="price2">10 MILLION</td>
            </tr>
            <tr>
                <th>Car Description</th>
                <td id="desc1">This one ass </td>
                <td id="desc2">This one mega ass </td>
            </tr>
            <tr>
                <th>Car Brand</th>
                <td id="brand1">FORD</td>
                <td id="brand2">HONDA </td>
            </tr>
            <tr>
                <th>Car mileage</th>
                <td id="mileage1">100000</td>
                <td id="milage2">1000000000000</td>
            </tr>
            <tr>
                <th>Car age</th>
                <td id="age1">50 Years</td>
                <td id="age2">60 Years</td>
            </tr>
            <tr>
                <th>Transmission Type</th>
                <td id="trans1">Manual</td>
                <td id="trans2">Automatic</td>
            </tr>
            <tr>
                <th>Engine Type</th>
                <td id="eng1">V8</td>
                <td id="eng2">V12</td>
            </tr>
        </table>

    </div>
</div>



</body>

</html>

