<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
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
    <form method= "POST" action = "{{route('userRegister')}}">
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
        <br>

        <!--submitting button-->
        <input id="submit" type = "submit" value = "Register"/>
        <br><br>
        <input type = "hidden" name = submitted" value = "true"/>

    </form>
    <!-- linking to login page -->
    <p> Already a user? <a href="/userLogin"> Login</a> </p>
</div>

</body>
</html>
