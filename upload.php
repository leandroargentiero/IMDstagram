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
        $p->Location = $_POST['location'];
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
                    <input type="hidden" name="location" id="location" value="">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
       $(document).ready(function(){
            if ("geolocation" in navigator) {
                /* geolocation is available */
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lng = position.coords.longitude; 
                    var lat = position.coords.latitude; 
                    
                    $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true", function(data){
                        console.log(data["results"][1]["formatted_address"]);
                        $("#location").attr("value", data["results"][1]["formatted_address"]);
                    });
                    
                    
                });
            } 
            else {
                /* geolocation IS NOT available */
            }
       }) 
    
    </script>
    </html>