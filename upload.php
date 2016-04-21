<?php
    include_once('includes/no-session.inc.php');
include_once('classes/post.class.php');

if(!empty($_POST)){    
if ($_FILES["file"]["error"] > 0)
{
//for error messages: see http://php.net/manual/en/features.fileupload.errors.php
switch($_FILES["file"]["error"])
 {
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
        $p = new Post();
        $p->moveImage();
        $p->Description = $_POST['desc'];
        $p->savePost();
        
        

 
}
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
                    
                    <label for="description">Description:</label>
                     <br>
                      <textarea rows="5" cols="40" name="desc" id="comment"></textarea>
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