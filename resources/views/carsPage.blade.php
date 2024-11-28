<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="stylesheet" href="{{ asset('css/productsPage.css') }}">
</head>
<body>
    <!-- Navigation bar-->



    <!-- Navbar for searching -->
    <div class="searchNav">
        <form action="carsPage.blade.php" class="searchBar">
            <input type="text" placeholder="Search Cars..">
            <button type="submit">Go</button>
        </form>
    </div>

    <!-- NavBar for Filtering-->
    <div class="filter">
        <ul>
            <li><a href="#suv">SUV</a></li>
            <li><a href="#saloon">Saloon</a></li>
            <li><a href="#hatchback">Hatchback</a></li>
            <li><a href="#coupe">Coupe</a></li>
            <li><a href="#van">Van</a></li>
        </ul>
    </div>

    <!-- Products Displayed -->
    <div class="row">

        <!-- Image 01 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 02 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 03 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 04 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 05 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 06 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 07 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 08 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

        <!-- Image 09 -->
        <div class="column">
            <img src="/public/assets/yaris.png" style="width: 350px;height:350px;">
            <h1>CAR</h1>
            <p>IN-STOCK: 10</p>
            <p class="price">£1000</p>
            <p><button>VIEW</button></p>
        </div>

    </div>

</body>
</html>
