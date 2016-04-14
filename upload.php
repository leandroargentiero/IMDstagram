<?php
    include_once('includes/no-session.inc.php');

    
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
echo "Upload: " . $_FILES["file"]["name"] . "<br />";
echo "Type: " . $_FILES["file"]["type"] . "<br />";
echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
echo "Stored in: " . $_FILES["file"]["tmp_name"];
    $filename = $_FILES["file"]["tmp_name"];
 $finfo = new finfo(FILEINFO_MIME_TYPE);
 $fileinfo = $finfo->file($filename);
    $newfilename = "files/" . $_FILES["file"]["name"];
    $_SESSION['image'] = $newfilename;
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $newfilename))
 {
        echo "<br><a href='showImage.php'>Check image</a>";
        echo $_SESSION['image'];
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
                      <textarea rows="5" cols="40" id="comment"></textarea>
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