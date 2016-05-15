<?php
    session_start();
    include_once ("includes/nav.inc.php");
    include_once ("classes/postDetail.class.php");
    $visible = "";
    if(isset($_GET['imageID'])){
        $_SESSION['imageID'] =  $_GET['imageID'];

        $post = new postDetail();
        $post->imageID = $_GET['imageID'];
        $image = $post->getImage();
        $avatar = $post->getAvatar();
        $username = $post->getUsername();
        $postTime = $post->getPostHour();
        $likeCount = $post->getLikes();

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

    if ($username['username'] == $_SESSION['username']){
        $visible = "visible";
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
        background-color: red;
    }


    ul.commentFeed-holder{
        background-color: #3E90D9;
        margin: 10px 5px 0 5px;
        height: 100px;
    }

    .commentFeed-items{
        background-color: #60C029;
        margin-top: 5px;

    }

    .comment-text{
        margin-left: 8px;
    }

    .comment-username{
        font-weight: bold;
        color: #06365F;
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
    .glyphicon-trash {
        float: right;
        margin-top: -25px;
        opacity: .5;
        cursor: pointer;
        visibility: hidden;
    }
    #visible {
        visibility: visible;
    }
</style>
<body>
    <div class="postDetail">
        <div class="innerLeft"><img src="<?php echo $image['fileLocation']; ?>" alt=""></div>
        <div class="innerRight">
            <div class="innerRightContainer">
                <div class="innerRightHeader">
                    <img class="avatar" src="<?php echo $avatar['avatar']; ?>" alt="">
                    <a href="profile.php"><p class="name"><?php echo $username['username']; ?></p></a>
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
                    <ul class="commentFeed-holder">
                        <?php $comments = array("a", "b", "c", "d"); ?>
                            <?php foreach( $comments as $key => $comment): ?>
                            <li class="commentFeed-items" id="_1"><span class="comment-username">kennymng</span><span class="comment-text">je foto is lelijk.</span></li>
                            <?php endforeach; ?>

                    </ul>
                </div>
                <div class="innerRightFooter">
                    <form id="commentForm" class="innerRightFooterForm" action="" method="post">
                        <img id="heart" class="<?php echo $class ?>" src="<?php echo $source ?>" alt="like">
                        <input id="commentField" type="textarea" name="commentField" placeholder="Add a comment...">
                        <input id="comment-btn-submit" type="submit" style="position: absolute; left: -9999px"/>
                    </form>
                    
                    <span class="glyphicon glyphicon-trash" id="<?php echo $visible; ?>" aria-hidden="true" title="Verwijder je foto"></span>
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="userID" value="1">
    <input type="hidden" id="userName" value="kennymng">
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js">


</script>
</html>