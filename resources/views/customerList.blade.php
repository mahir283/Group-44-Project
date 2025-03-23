<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="{{ asset('css/customerList.css') }}">
</head>
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
</header>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>
</button>

@if(Auth::check() && Auth::user()->user_type === 'admin')
    <!-- Display Success or Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <body>
    <div class="customer-list-container">
        <h1>Customer List</h1>
        <form action="{{ route('customerList') }}" method="GET" class="listForm">
            <input type="text" name="search" class="search" placeholder="Search Customer">
            <button type="submit" class="btn">Search</button>
        </form>
        <div class="customer-info">
            @foreach($users as $user)
                <div class="items">
                    <div class="box">
                        <div class="customer-content">
                            <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone number:</strong> {{ $user->phone_number }}</p>
                            <p><strong>Username:</strong> {{ $user->username }}</p>

                            <!-- Delete Button -->
                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>

                            <!-- Edit Button -->
                            <a href="{{ route('customer.amendments.show', $user->id) }}" class="edit-btn">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
        <!-- Display a message for non-admin users -->
        <div class="alert alert-error">
            You do not have permission to access this page.
        </div>
    @endif
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
