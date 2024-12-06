<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('../css/login.css') }}">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-error">
            {{ session('fail') }}
        </div>
    @endif


    <form method="POST" action = "{{route('userLogin')}}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="userEmail" placeholder="Email Address" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="userPassword"  placeholder="Password" required>
        </div>

        <!--
        <button type="submit">Login</button>
        -->
        <!-- Submit button -->
        <input id="submit" type = "submit" value = "Register"/>
        <br><br>
        <input type = "hidden" name = submitted" value = "true"/>
    </form>

    <div id="additional-links">
        <p>Not already a user?<a href="/userRegister">Sign Up</a></p>
    </div>
</div>
</body>
</html>

