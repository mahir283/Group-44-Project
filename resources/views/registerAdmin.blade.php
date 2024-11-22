<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
<!-- Class container for form-->
<div class="formContainer">

    <h1>Create Account</h1>
    <!-- Creating form-->
    <form method= "post" action = "registerAdmin.blade.php">
        <div>
            <!-- Required input firstname text-->
            <input required type = "text" name = "firstname" id= "fname" placeholder= "First Name" />
        </div>
        <div>
            <!-- Required input lastname text-->
            <input required type = "text" name = "lastname" id= "lname" placeholder= "Last Name"/>
        </div>
        <div>
            <!-- Required input email using standard email type-->
            <input required type = "email" name = "email" id= "useremail" placeholder= "Email"/>
        </div>
        <div>
            <!-- Required input username text-->
            <input required type = "text" name = "username" id= "uname" placeholder= "Username"/>
        </div>
        <div>
            <!-- Required input password text-->
            <input required type = "password" name = "password" id= "pword" placeholder= "Password"/>
        </div>
        <br>
        <!-- Submit Button-->
        <input type = "submit" value = "Register"/>
        <br><br>
        <input type = "hidden" name = submitted" value = "true"/>
    </form>
    <!-- linking to other pages of login admin and user register-->
    <p> Already a user? <a href="login.admin.blade.php"> Login</a> </p>
    <p> Not a user? <a href="registerUser.blade.php"> Register</a> </p>
</div>

</body>
</html>
