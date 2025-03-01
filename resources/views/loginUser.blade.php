<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
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
    </div>
</div>
</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
