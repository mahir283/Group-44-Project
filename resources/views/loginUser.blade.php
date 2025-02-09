<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>

    <!-- Display the message if it's passed in session -->
    @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-error">
            {{ session('fail') }}
        </div>
    @endif

    <form method="POST" action="{{ route('userLogin') }}">
        @csrf

        <!-- Hidden field to store the intended URL -->
        <input type="hidden" name="intended_url" value="{{ session('url.intended') ?? url()->previous() }}">

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="userEmail" placeholder="Email Address" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="userPassword" placeholder="Password" required>
        </div>

        <!-- Submit button -->
        <input id="submit" type="submit" value="Login" />
        <br><br>

        <!-- Lets me track submissions using a hidden input -->
        <input type="hidden" name="submitted" value="true"/>
    </form>

    <div id="additional-links">
        <p>Not already a user? <a href="{{ route('userRegister') }}">Sign Up</a></p>
        <p>Are you an Admin? <a href="{{ route('adminLogin') }}">Admin Login</a></p>
    </div>
</div>
</body>
</html>
