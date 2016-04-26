<?php
    session_start();
    include_once ("includes/nav.inc.php");
    include_once ("classes/postDetail.class.php");

    if(isset($_GET['imageID'])){
        $post = new postDetail();
        $post->imageID = $_GET['imageID'];
        $image = $post->getImage();
        $avatar = $post->getAvatar();

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
        margin: 15px 0 0 0;
    }
    .timestamp{
        display: inline-block;
        margin: 15px 0 0 230px;
    }


</style>
<body>
    <div class="postDetail">
        <div class="innerLeft"><img src="<?php echo $image['fileLocation']; ?>" alt=""></div>
        <div class="innerRight">
            <div class="innerRightContainer">
                <div class="innerRightHeader">
                    <img class="avatar" src="<?php echo $avatar['avatar']; ?>" alt="">
                    <p class="name">Test123</p>
                    </ul>
                </div>
                <div class="innerRightSecondHeader">
                    <p class="likes">146 Likes</p>
                    <p class="timestamp">16H</p>
                </div>
                <div class="commentFeed"></div>
                <div class="innerRightFooter">
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>