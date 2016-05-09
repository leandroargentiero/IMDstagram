<?php
    session_start();

    include_once ("classes/users.class.php");

    if(!empty($_POST)){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $users = new Users();
        $users->Username = $username;
        $users->Password = $password;
        $users->canLogin();

        if($users->canLogin()){
            $_SESSION['user'] = $username;
            $users->followSelf();
            header('Location: index.php');
        }
        else
        {
            $error = "Your username or password was incorrect.";
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
        </div>
        <?php
             if(isset($result)) {
                 echo $result;
             }
        ?>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
				
               	<input type="submit" name="btnLogin" id="btnLogin" value="Log in" >

                <?php
                if( isset($error) ) {
                    echo "<p class='error'>$error</p>";
                }

                ?>
            </form>
        </div>
        <footer>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </footer>
    </div>
</body>

</html>