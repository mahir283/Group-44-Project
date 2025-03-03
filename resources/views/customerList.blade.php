<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Page</title>
    <link rel="stylesheet" href="{{ asset('css/customerList.css') }}">
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
@if(Auth::check() && Auth::user()->user_type == 'admin')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session ('error'))
    <div class="alert alert-error">
        {{session('error')}}
    </div>
@endif
<div class = "customer-list-container">
    <h1>Customer List</h1>
    <div class="search-bar">
        <input type="text" class="search" placeholder="Search customers...">
    </div>
    <div class = "customer-info">
        @foreach($users as $user)
        <div class = "items">
                <div class = "box">
                    <div class = "customer-content">
                        <p><strong>Name:</strong>{{ $user->first_name }} {{ $user->last_name }} </p>
                        <p><strong>Email:</strong> {{$user->email }}</p>
                        <p><strong>Phone number:</strong> {{$user->phone_number }}</p>
                        <p><strong>Username:</strong> {{ $user->username }}</p>

                        <form action="{{ route('user.delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
</div>
@endif
</body>
</html>
