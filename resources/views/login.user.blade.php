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

    <form action="/login" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="userEmail" placeholder="Email Address" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="userPassword"  placeholder="Password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="additional-links">
        <a href="/register">Sign Up</a>
        <a href="/forgot-password">Forgot Password?</a>
    </div>
</div>
</body>
</html>

