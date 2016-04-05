<?php
    include_once ("classes/users.class.php");

    if(!empty( $_POST ) ){
        // password options
        $options = $options = [
            'cost'=> 12
        ];
        // bcrypting password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);

        // creating new object for 'users' on register
        $users = new Users();
        $users->Email = $_POST['email'];
        $users->Fullname = $_POST['fullname'];
        $users->Username = $_POST['username'];
        $users->Password = $password;
        $users->Save();
    }
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="images/logo.png" alt="logo instagram">
            <p class="introduction">Sign up to see photos and videos from your friends.</p>
            <a class="btnLoginFacebook" href="#">Log in with Facebook</a>
            <div class="separator">
                <div class="separator-line"></div>
                <p class="separator-or">OR</p>
            </div>
        </div>
        <div class="signup-form">
            <form action="" method="post">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="text" name="fullname" id="fullname" placeholder="Full Name">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
				
               	<input type="submit" name="btnSignUp" id="btnSignup" value="Sign up" >
            </form>
        </div>
        <footer>
            <p>By signin up, you agree to our <br> <span>Terms &amp; Privacy Policy</span></p>
        </footer>
    </div>
</body>

</html>