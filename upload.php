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
        $p->Filter = $_POST['filter'];
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
        <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
    </head>

    <body>

    <div class="container">
            <div class="header">
                <a href="index.php"><img class="logo" src="images/logo.png" alt="logo instagram"></a>
            </div>
            <h2>Upload an image</h2>
            <div class="form">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input type="file"  name="file" id="fileUpload" />

                    <figure id="figureUploadPreview" class="">
                        <img id="uploadPreview" src="" alt="Upload Preview"/>
                    </figure>

                    <label id="dropdownFiltersLabel" for="filter">Add a filter</label>
                    <select id="dropdownFilters" name="filter">
                        <option selected="selected">Pick your filter</option>
                        <option value="_1977">_1977</option>
                        <option value="aden">aden</option>
                        <option value="brooklyn">brooklyn</option>
                        <option value="clarendon">clarendon</option>
                        <option value="earlybird">earlybird</option>
                        <option value="gingham">gingham</option>
                        <option value="hudson">hudson</option>
                        <option value="inkwell">inkwell</option>
                        <option value="lark">lark</option>
                        <option value="lofi">lofi</option>
                        <option value="mayfair">mayfair</option>
                        <option value="moon">moon</option>
                        <option value="nashville">nashville</option>
                        <option value="perpetua">perpetua</option>
                        <option value="reyes">reyes</option>
                        <option value="rise">rise</option>
                        <option value="slumber">slumber</option>
                        <option value="toaster">toaster</option>
                        <option value="walden">walden</option>
                        <option value="willow">willow</option>
                        <option value="xpro2">xpro2</option>
                    </select>

                    <input type="hidden" name="location" id="location" value="">

                    <label for="description">Description:</label>
                     <br>
                      <textarea id="descriptionbox" rows="5" cols="40" name="desc" id="comment"></textarea>
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

    <script src="js/scripts.js"></script>

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