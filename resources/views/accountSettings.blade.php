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
                @endif
            </div>
        </nav>
    </header>
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
        <h1>Account Setting</h1>
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
</html>
