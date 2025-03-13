<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="{{ asset('css/accountSettings.css') }}">
</head>
<body>

<div class="homepageDiv">
    <header>
        <nav class="navbar">
            <div class="logo">BRUMBRUMM</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">HOME</a></li>
                <li><a href="{{ url('/products') }}">PRODUCTS</a></li>
                <li><a href="{{ url('/aboutUs') }}">ABOUT US</a></li>
                <li><a href="{{ url('/contact') }}">CONTACT US</a></li>
                <li><a href="{{ url('/basketPage') }}">BASKET</a></li>
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
                        <button id="loginButton" class = "btn"  >LOGOUT</button>
                    </form>
                @else
                    <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                    <a href="{{ url('registerUser') }}" class="btn register">Register</a>
                @endif
            </div>
        </nav>
    </header>
    <button id="theme-switch">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

    </button>
</div>

<!-- Display Success Message if available -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Main container for User Information and Password Change -->
<div class="settings-container">
    <!-- User Information Section -->
    <div class="user-info">
        <h1>Account Settings</h1>
        <h2>Personal Information</h2>

        <form method="POST" action="{{ route('account.update.details') }}">
            @csrf
            @method('PUT')
            <div class="details">
                <strong>Username</strong>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Username">
                @error('username') <span class="error">{{ $message }}</span> @enderror

                <strong>First Name</strong>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="First Name">
                @error('first_name') <span class="error">{{ $message }}</span> @enderror

                <strong>Last Name</strong>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Last Name">
                @error('last_name') <span class="error">{{ $message }}</span> @enderror

                <strong>Email</strong>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                @error('email') <span class="error">{{ $message }}</span> @enderror

                <strong>Phone Number</strong>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Phone Number">
                @error('phone_number') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="save-button">Save</button>
        </form>
    </div>

    <!-- Password Change Section -->
    <div class="password-change">
        <h2>Update Password</h2>

        <form method="POST" action="{{ route('account.update.password') }}">
            @csrf
            @method('PUT')

            <div class="password-field">
                <input type="password" name="current_password" placeholder="Current Password">
                @error('current_password') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="password-field">
                <input type="password" name="new_password" placeholder="New Password" minlength="6" required>
                @error('new_password') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="password-field">
                <input type="password" name="new_password_confirmation" placeholder="Confirm New Password">
                @error('new_password_confirmation') <span class="error">{{ $message }}</span> @enderror
            </div>

            <br>
            <button type="submit" class="update-button">Update Password</button>
        </form>
    </div>
</div>

</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
