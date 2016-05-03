<?php
    include_once('includes/no-session.inc.php');
    include_once('classes/feed.class.php');
    $userID = $_SESSION['userID'];
    $feed = new Feed();
    $feed->getFeed($userID);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UT F-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include_once("includes/nav.inc.php"); ?>

    
    
    <div class="indexFeed">
            <?php foreach($feed->Results as $post): ?>
            <div class="feedPic">
               <img src="<?php echo $post['fileLocation']; ?>" alt="">
                </div>
                <?php endforeach; ?>
                
        </div>
        
        <div class="loadMoreContainer">
        
            <button class="btnLoadMore">Load More</button>
        
        </div>
        
    
        <a href="upload.php" id="floatingBtn">+</a>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>