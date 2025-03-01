<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<button id="theme-switch">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>

</button>
<body>
<!-- Class container for form-->
<div class="formContainer">

    <h1>Create Account</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Creating form-->
    <form method= "POST" action = "/userRegister">
        @csrf
        <div>
            <!-- Required input firstname text-->
            <input required type = "text" name = "firstname" id= "fname" placeholder= "First Name" />
        </div>
        <div>
            <!-- Required input lastname text-->
            <input required type = "text" name = "lastname" id= "lname" placeholder= "Last Name"/>
        </div>
        <div>
            <!-- Required input email using standard email-->
            <input required type = "email" name = "email" id= "useremail" placeholder= "Email"/>
        </div>
        <div>
            <!-- Required input telephone number using telephone type ?-->
            <input required type = "tel" name = "telnum" id= "telephone" placeholder= "Phone Number"/>
        </div>
        <div>
            <!-- Required input username using text-->
            <input required type = "text" name = "username" id= "uname" placeholder= "Username"/>
        </div>
        <div>
            <!-- Required input password using password type-->
            <input required type = "password" name = "password" id= "pword" placeholder= "Password"/>
        </div>
        <select name="usertype" id="usertype">
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>

        <!--submitting button-->
        <input id="submit" type = "submit" value = "Register"/>
        <br><br>
        <input type = "hidden" name = submitted" value = "true"/>

    </form>
    <!-- linking to login page -->
    <div id="additional-links">
        <p> Already a user? <a href="{{ route('userLogin') }}">Login</a> </p>
    </div>
</div>

</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
</html>
