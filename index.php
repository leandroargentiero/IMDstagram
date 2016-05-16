<?php
    include_once('includes/no-session.inc.php');
    include_once('classes/feed.class.php');
    include_once('classes/postDetail.class.php');
    include_once ('classes/users.class.php');

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
    <link rel="stylesheet" href="css/cssgram.min.css">
</head>
<body>

    <?php include_once("includes/nav.inc.php"); ?>

    <div class="indexFeed">
            <?php $i = 0 ?>
            <?php foreach($feed->Results as $post): ?>
                <?php $i++ ?>
                <div class="feedNav">
                    <a href="profile.php?userID=<?php echo $post['imageUserID']; ?>">
                        <img class="feedNavPic" src="<?php
                        $avatar = new postDetail();
                        $avatar = $avatar->getAvatar($post['imageID']);
                        echo $avatar['avatar'];
                        ?>" alt="">
                    </a>
                    <a href="profile.php?userID=<?php echo $post['imageUserID']; ?>" class="feedNavUsername">
                        <h2 class="name">
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
                        <div class="feedLocation">
                            <img class="location-ping"src="images/location-pin.png" alt="">
                            <h2><?php echo $post['location']; ?></h2>
                        </div>
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
                        <ul class="commentsList<?php echo $i; ?>">
                            <?php
                                $singlePost = new postDetail();
                                $username = $singlePost->getUsername($post['imageID']);
                                $description = $singlePost->getDescription($post['imageID']);
                                $comments = $singlePost->getComments($post['imageID']);
                            ?>
                            <input type="hidden" class="imageID<?php echo $i; ?>" value="<?php echo $post['imageID']; ?>">
                            <input type="hidden" class="userID" value="<?php echo $_SESSION['userID']; ?>">

                            <li><a href="profile.php?userID=<?php echo $comment['commentUserID']; ?>">
                                    <?php echo $username['username']; ?>
                                </a>
                                <span class="comment-text"><?php echo $description['description']; ?></span>
                            </li>

                            <?php foreach( $comments as $comment): ?>
                                <li>
                                    <a href="profile.php?userID=<?php echo $comment['commentUserID']; ?>">
                                        <?php
                                        $user = new Users();
                                        $user->getProfile($comment['commentUserID']);
                                        $username = $user->Username;
                                        echo $username;
                                        ?></a>
                                    <span class="comment-text"><?php echo htmlspecialchars($comment['commentText']); ?></span>
                                </li>
                            <?php endforeach; ?>
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
                            <input class="commentField commentField<?php echo $i; ?>" type="text" name="commentField" placeholder="Add a comment...">
                            <input class="comment-btn-submit" type="submit" value="<?php echo $i; ?>"
                            style="position: absolute; left: -9999px"/>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
        
    <div class="loadMoreContainer">
        <button class="btnLoadMore">Load More</button>
    </div>
        
    
        <a href="upload.php" id="floatingBtn">+</a>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</html>