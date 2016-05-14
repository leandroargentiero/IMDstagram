<?php
include_once('includes/no-session.inc.php');
include_once('classes/users.class.php');
include_once('classes/feed.class.php');
include_once('classes/postDetail.class.php');

// Checken wiens account geladen moet worden
if(!empty($_GET)){
    
    $userID = $_GET['userID'];
    $_SESSION['targetUserID'] = $_GET['userID'];

    // Profielinformatie ophalen
    
    $profile = new Users();
    $profile->getProfile($userID);
    
    // informatie over follows
    // following
    $profile->getFollowCount($userID);
    
    // followers
    $profile->getFollowerCount($userID);
    
    
    // volg ik dit account al?
    
    
    // Variabelen voor knoppen en teksten invullen.
    $username = $profile->Username;
    $bioText = $profile->Bio;
    $avatar = $profile->Image;
    $userID = $profile->UserID;
    $private = $profile->Privacy;
    
    // Checken of de user private is of niet.
    if($private == "yes"){

        // User is private, dus eerst checken of de feed getoond mag worden.
        if($profile->followCheck()){
            // gevolgd? feed tonen.
            $btnClass = "btnUnfollow";
            $btnText = "Volgend";
            $feed = new Feed();
            $feed->getProfileFeed($userID); 
        }
        else {
        
            if($profile->privateFollowCheck()){
                // aanvraag al verstuurd
                 $btnClass = "btnPrivateRequested";
                $btnText = "Aangevraagd";
            }
            else {
                // als hij nog niet gevolgd wordt, geen feed, wel boodschap.
                $btnClass = "btnFollowPrivate";
                $btnText = "Volgen";
            }
            $privacyMessage = "Sorry, deze gebruiker is privé. Je kan pas de posts zien als je verzoek is goedgekeurd.";
        }
    }
    else {
        // FEED OPHALEN
    $feed = new Feed();
    $feed->getProfileFeed($userID); 
        
        // Checken of deze gebruiker al gevolgd wordt.
    if($profile->followCheck()){
        $btnClass = "btnUnfollow";
        $btnText = "Volgend";
    }
    else {
            $btnClass = "btnFollow";
            $btnText = "Volgen";
    }
        
    }
    
    
}
else {
    $userID = $_SESSION['userID'];
    
    // follows en profielinfo ophalen
    $profile = new Users();
    $profile->getProfile($userID);
    $profile->getFollowCount($userID);
    $profile->getFollowerCount($userID);
    
    $btnText = "Profiel bewerken";
    $btnClass = "btnEditProfile";
    $username = $profile->Username;
    $bioText = $profile->Bio;
    $avatar = $profile->Image;
    $userID = $profile->UserID;
    
    // get feed
    $feed = new Feed();
    $feed->getProfileFeed($userID);
}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include_once("includes/nav.inc.php"); ?>
    
    <div class="profileInfo">
        <img class="profilePhoto" src="<?php echo $avatar; ?>" alt="profile photo">
        <div class="profileDetails">
            <div class="editProfile">
                <p class="userName"><?php echo $username; ?></p>

                <button id="" class="<?php echo $btnClass; ?>"><?php echo $btnText; ?></button>
            </div>

            <p class="userDescription"><?php echo $bioText; ?></p>

            <ul class="userStats">
                <li><span><?php echo $feed->PostCount; ?></span> posts</li>
                <li><span><?php echo $profile->FollowerCount; ?></span> followers</li>
                <li><span><?php echo $profile->FollowCount; ?></span> following</li>
            </ul>

        </div>

    </div>

    <main class="feedContainer">

        <div class="profileFeed">

               <span class="privacyMessage"><?php echo $privacyMessage; ?></span>
                <?php foreach($feed->Results as $post): ?>
                    <a href="postDetail.php?imageID=<?php echo $post['imageID']; ?>">
                        <div class="feedBox">
                            <img src="<?php echo $post['fileLocation']; ?>" alt="">
                            <div class="overlay">
                                <div class="likes">
                                    <img class="overlay-icon"src="images/white_heart.png" alt="">
                                    <p>
                                        <?php
                                            $likes = new postDetail();
                                            $likecount = $likes->getLikes($post['imageID']);
                                            echo $likecount;
                                        ?>
                                    </p>
                                </div>
                                <div class="comments">
                                    <img class="overlay-icon" src="images/comments.png" alt="">
                                    <p>0</p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
        </div>
        <div class="loadMoreContainer">
        
            <button class="btnLoadMore">Load More</button>
        
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>