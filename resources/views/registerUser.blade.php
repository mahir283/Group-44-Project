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
    <!-- Creating form-->
    <form method= "post" action = "registerUser.blade.php">
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
            <!-- Required input address using text-->
            <input required type = "text" name = "address" id= "address" placeholder= "Address"/>
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
        <input type = "submit" value = "Register"/>
        <br><br>
        <input type = "hidden" name = submitted" value = "true"/>
    </form>
    <!-- linking to other pages of login and admin register-->
    <p> Already a user? <a href="loginUser.blade.php"> Login</a> </p>
    <p> Admin Register <a href="registerAdmin.blade.php"> Register</a> </p>
</div>

</body>
</html>
