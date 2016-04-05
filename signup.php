<?php
    include_once ("classes/users.class.php");

    if(!empty( $_POST ) ){
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ( empty( $email ) || empty( $fullname ) || empty( $username ) || empty( $password ) )
        {
            $error = "Sorry, something went wrong creating your account. Please try again soon.";
        }
        else
        {
            // creating new object for 'users' on register
            $users = new Users();
            $users->Email = $email;
            $users->Fullname = $fullname;
            $users->Username = $username;
            $users->Password = $password;
            $users->Register();
        }

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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="text" name="fullname" id="fullname" placeholder="Full Name">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
				
               	<input type="submit" name="btnSignUp" id="btnSignup" value="Sign up" >

                <?php
                if( isset($error) ) {
                    echo "<p class='error'>$error</p>";
                }
                ?>
            </form>
        </div>
        <footer>
            <p>By signin up, you agree to our <br> <span>Terms &amp; Privacy Policy</span></p>
        </footer>
    </div>
</body>

</html>