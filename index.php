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
    <link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
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
                        <figure class="<?php echo $post['filter']; ?>">
                            <img src="<?php echo $post['fileLocation']; ?>" alt="">
                        </figure>
                    </a>
                </div>
                <div class="feedFooter">
                    <div class="feedFooterTop">
                        <p>
                            <?php
                                $likeCounter = new postDetail();
                                $likes = $likeCounter->getLikes($post['imageID']);
                                if($likes == 0) {
                                    echo "No likes yet";
                                }
                                elseif($likes == 1)
                                {
                                    echo $likes." Like";
                                }
                                else
                                {
                                    echo $likes." Likes";
                                }
                            ?>
                        </p>
                        <ul class="description">
                            <li>
                                <a href="profile.php?userID=<?php echo $post['imageUserID']; ?>"><?php echo $username['username']; ?></a>
                                <span>
                                    <?php
                                        $description = new postDetail();
                                        $imageDescription = $description->getDescription($post['imageID']);
                                        echo $imageDescription['description'];
                                    ?>
                                </span>
                            </li>
                        </ul>
                        </h1>
                    </div>
                    <div class="feedFooterBottom">
                        <?php
                        $like = new postDetail();

                        $likeCheck = $like->likeCheck($post['imageID']);

                        if($likeCheck)
                        {
                            $source = "images/heart_filled.png";
                            $class = "btnUnlike";
                        }
                        else
                        {
                            $source = "images/heart_blank.png";
                            $class = "btnLike";
                        }

                        ?>
                        <form class="feedFooterBottomForm" action="" method="post">
                            <img class="likeHeart <?php echo $class; ?>" src="<?php echo $source; ?>" alt="like"
                                 value="<?php echo $post['imageID'] ?>">
                            <input id="commentField" type="text" name="commentField" placeholder="Add a comment...">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
        
    <div class="loadMoreContainer">
        <button class="btnLoadMore">Load More</button>
    </div>
        
    
        <a href="upload.php" id="floatingBtn">+</a>
    <!--<a href="includes/logout.inc.php">logout</a>-->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</html>