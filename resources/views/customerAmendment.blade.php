<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Amendment</title>
    <link rel="stylesheet" href="{{ asset('css/customerAmendment.css') }}">
</head>
<body>
<div class="homepageDiv">
    <header>
        <nav class="navbar">
            <div class="logo">BrumBrumm</div>
            <ul class="nav-links">
                <li><a href= "{{ url("/") }}">Home</a></li>
                <li><a href="{{ url("/products") }}">Products</a></li>
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
        <button id="theme-switch">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>


        </button>
    </header>
</div>

<!-- Displaying Details -->
<div class="userDetails">
    <div class="detailsContainer">
        <h1>Customer Amendment</h1>
        <h2>User Information</h2>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="user">
            <form class="details" action="{{ route('customer.amendments.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="username"><strong>Username</strong></label>
                <input type="text" id="uName" name="username" value="{{ $customer->username }}"><br>

                <label for="first_name"><strong>First Name</strong></label>
                <input type="text" id="fName" name="first_name" value="{{ $customer->first_name }}"><br>

                <label for="last_name"><strong>Last Name</strong></label>
                <input type="text" id="lName" name="last_name" value="{{ $customer->last_name }}"><br>

                <label for="email"><strong>Email</strong></label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}"><br>

                <label for="phone_number"><strong>Phone Number</strong></label>
                <input type="text" id="phoNy" name="phone_number" value="{{ $customer->phone_number }}"><br>

                <!-- User Status Dropdown -->
                <label for="user_type"><strong>User Status</strong></label>
                <select id="userStatus" name="user_type">
                    <option value="customer" {{ $customer->user_type === 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ $customer->user_type === 'admin' ? 'selected' : '' }}>Admin</option>
                </select><br>

                <!-- Uneditable Fields -->
                <label for="accountDate"><strong>Account Creation Date</strong></label>
                <input type="text" id="accountDate" name="accountDate" value="{{ $customer->created_at }}" readonly><br>

                <label for="updateDate"><strong>Last Updated</strong></label>
                <input type="text" id="updateDate" name="updateDate" value="{{ $customer->updated_at }}" readonly><br>

                <div class="updateButton">
                    <input id="submitButton" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
