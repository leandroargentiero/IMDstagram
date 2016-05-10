<?php
    session_start();
    include_once ("includes/nav.inc.php");
    include_once ("classes/postDetail.class.php");

    if(isset($_GET['imageID'])){
        $_SESSION['imageID'] =  $_GET['imageID'];

        $post = new postDetail();
        $post->imageID = $_GET['imageID'];
        $image = $post->getImage();
        $avatar = $post->getAvatar($_GET['imageID']);
        $username = $post->getUsername($_GET['imageID']);
        $postTime = $post->getPostHour($_GET['imageID']);
        $likeCount = $post->getLikes($_GET['imageID']);
        $userID = $post->getUserID($_GET['imageID']);

        $likeCheck = $post->likeCheck();

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
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .postDetail{
        background-color: grey;
        width: 800px;
        height: 400px;
        margin: 100px auto 0 auto;
        display: flex;
        box-shadow: 0px 3px 10px #a5a5a6;
    }
    .innerLeft{
        width: 400px;
        height: 400px;
    }
    .innerLeft img{
        object-fit: cover;
        width: 100%;
        height: 100%;
        background-color: gold;
    }
    .innerRight{
        width: 400px;
        height: 400px;
        background-color: white;
    }
    .innerRightContainer{
        padding: 2em;
    }
    .innerRightHeader{
        height: 50px;
        border-bottom: 1px solid #dddbd9;
    }
    .innerRightSecondHeader{
        height: 50px;
        border-bottom: 1px solid #dddbd9;
    }
    .innerRight .commentFeed{
        height: 200px;
        border-bottom: 1px solid #dddbd9;

    }
    .avatar{
        object-fit: cover;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        float: left;
        display: inline-block;
        margin: -10px 0 0 0;
    }
    .name{
        font-family: 'instaBold', 'sans-serif';
        font-size: .9em;
        display: inline-block;
        margin: 9px 0 0 20px;
        color: #30618B;
    }
    .innerRightSecondHeader{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    .likes{
        font-size: .9em;
        color: #7B7A7C;
    }
    .timestamp{
        font-size: .9em;
        color: #7B7A7C;
    }
    .commentFeed {
        overflow-y: scroll;
    }
    .innerRightFooterForm{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    #heart{
        margin: 10px 0 0 0;
    }
    #commentField{
        width: 300px;
        margin: 10px 0 0 0;
        font-size: .8em;
        padding: 10px 0 10px 10px;
        border: none;
        color: #7B7A7C;
    }

</style>
<body>
    <div class="postDetail">
        <div class="innerLeft"><img src="<?php echo $image['fileLocation']; ?>" alt=""></div>
        <div class="innerRight">
            <div class="innerRightContainer">
                <div class="innerRightHeader">
                    <a href="profile.php?userID=<?php echo $userID['imageUserID']; ?>"><img class="avatar" src="<?php echo $avatar['avatar']; ?>" alt=""></a>
                    <a href="profile.php?userID=<?php echo $userID['imageUserID']; ?>"><p class="name"><?php echo $username['username']; ?></p></a>
                    </ul>
                </div>
                <div class="innerRightSecondHeader">
                    <p class="likes"><?php
                                       if($likeCount == 0) {
                                           echo "No likes yet";
                                       }
                                       elseif($likeCount == 1)
                                       {
                                           echo $likeCount." Like";
                                       }
                                       else
                                       {
                                           echo $likeCount." Likes";
                                       }
                                     ?>
                    </p>
                    <p class="timestamp"><?php echo $postTime ?></p>
                </div>
                <div class="commentFeed">
                    <ul>
                    </ul>
                </div>
                <div class="innerRightFooter">
                    <form class="innerRightFooterForm" action="" method="post">
                        <img id="heart" class="<?php echo $class ?>" src="<?php echo $source ?>" alt="like">
                        <input id="commentField" type="text" name="commentField" placeholder="Add a comment...">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</html>