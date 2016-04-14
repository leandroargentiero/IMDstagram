<?php
    include_once('includes/no-session.inc.php');

    //this file contains the code to process the upload of files
    if ($_FILES["file"]["error"] > 0){
        //for error messages: see http://php.net/manual/en/features.fileupload.errors.php
        switch($_FILES["file"]["error"]){
            case 1:
                $error = "U mag maximaal 2MB opladen.";
                break;
            default:
                $error = "Sorry, uw upload kon niet worden verwerkt.";
        }
        echo $error . "<br />";
    } 
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["file"]["tmp_name"];
    } 

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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="fileUpload" />
                <br />
                <input type="submit" name="submit" value="Upload Now!" />

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