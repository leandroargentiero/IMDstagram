<?php
    include_once('includes/no-session.inc.php');
    include_once('classes/feed.class.php');
    include_once('classes/postDetail.class.php');

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
                <div class="feedNav">
                    <a href="profile.php?userID=<?php echo $post['imageUserID']; ?>">
                        <img class="feedNavPic" src="<?php
                        $avatar = new postDetail();
                        $avatar = $avatar->getAvatar($post['imageID']);
                        echo $avatar['avatar'];
                        ?>" alt="">
                    </a>
                    <a href="profile.php?userID=<?php echo $post['imageUserID']; ?>" class="feedNavUsername">
                        <h2>
                            <?php
                                $username = new postDetail();
                                $username = $username->getUsername($post['imageID']);
                                echo $username['username'];
                            ?>
                        </h2>
                    </a>
                    <p class="feedNavTimestamp">
                        <?php
                            $timestamp = new postDetail();
                            $timestamp = $timestamp->getPostHour($post['imageID']);
                            echo $timestamp;
                        ?>
                    </p>
                </div>
                <div class="feedPic">
                    <a href="postDetail.php?imageID=<?php echo $post['imageID']; ?>">
                        <img src="<?php echo $post['fileLocation']; ?>" alt="">
                    </a>
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