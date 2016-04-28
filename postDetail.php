<?php
    session_start();
    include_once ("includes/nav.inc.php");
    include_once ("classes/postDetail.class.php");

    if(isset($_GET['imageID'])){
        $post = new postDetail();
        $post->imageID = $_GET['imageID'];
        $image = $post->getImage();
        $avatar = $post->getAvatar();
        $username = $post->getUsername();

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
    .likes{
        display: inline-block;
        float: left;
        font-size: .9em;
        margin: 18px 0 0 0;
        color: #7B7A7C;
    }
    .timestamp{
        display: inline-block;
        margin: 18px 0 0 245px;
        font-size: .9em;
        color: #7B7A7C;
    }
    .commentFeed {
        overflow-y: scroll;
    }
    .like img{
        margin-top: 15px;
        float: left;
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
                    <img class="avatar" src="<?php echo $avatar['avatar']; ?>" alt="">
                    <a href=""><p class="name"><?php echo $username['username']; ?></p></a>
                    </ul>
                </div>
                <div class="innerRightSecondHeader">
                    <p class="likes">146 Likes</p>
                    <p class="timestamp">16h</p>
                </div>
                <div class="commentFeed">
                    <ul>
                        li
                    </ul>
                </div>
                <div class="innerRightFooter">
                    <form action="" method="post">
                        <a class="like" href="#"><img id="like" src="images/heart_blank.png" alt="like"></a>
                        <input id="commentField" type="text" name="commentField" placeholder="Add a comment...">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>