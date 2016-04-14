<?php
    include_once('includes/no-session.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Imdstragram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="images/logo.png" alt="logo instagram">
        </div>
        <h2>Upload an image</h2>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                

                <?php
                if( isset($error) ) {
                    echo "<p class='error'>$error</p>";
                }

                ?>
            </form>
        </div>
    </div>
</body>

</html>