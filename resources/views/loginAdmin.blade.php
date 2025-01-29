<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="login-container">
    <h2>Admin Login</h2>

    <form action="/adminLogin" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="adminEmail" placeholder="Email Address" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="adminPassword"  placeholder="Password" required>
        </div>

        <!-- submit button -->
        <input id="submit" type="submit" value="Login" />
    </form>
        <br><br>

    <div id="additional-links">
        <p>Don't have an account? <a href = "{{ route('adminRegister') }}">Sign up</a></p>
        <p>Are you a user? <a href="{{ route('userLogin') }}">User Login</a></p>
    </div>
</div>
</body>
</html>
