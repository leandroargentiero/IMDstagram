<?php
include_once('includes/no-session.inc.php');


// Checken wiens account geladen moet worden
if(!empty($_GET)){
    
    $userID = $_GET['userID'];
    $_SESSION['targetUserID'] = $_GET['userID'];
    // Profielinformatie ophalen
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
    $getProfile = $conn->prepare("select userID, username, password, bio, avatar from users where userID = :userID");
    $getProfile->bindValue(':userID', $userID);
    $getProfile->execute();
    $profileInfo = $getProfile->fetch(PDO::FETCH_ASSOC);
    
    
    // volg ik dit account al?
    $targetUserID = $_SESSION['targetUserID'];
    $requestUserID = $_SESSION['userID'];
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
    $getFollowInfo = $conn->prepare("select * from follows where requestUserID = :requestUserID and targetUserID = :targetUserID");
    $getFollowInfo->bindValue(":requestUserID", $requestUserID);
    $getFollowInfo->bindValue(":targetUserID", $targetUserID);
    $getFollowInfo->execute();
    $count = $getFollowInfo->rowCount();
    echo $count;
    if($count == 1){
        $btnClass = "btnUnfollow";
        $btnText = "Volgend";
    }
    else {
       $btnClass = "btnFollow";
        $btnText = "Volgen";
    }
    
    // Variabelen voor knoppen en teksten invullen.
    $bioText = $profileInfo['bio'];
    $username = $profileInfo['username'];
    $avatar = $profileInfo['avatar'];
    
}
else {
    // alle profielinfo zit in $_SESSION
    // knop: profiel bewerken -> editProfile.php
    
    // follows: info uit tabel 'follows'
    
    
   $username = $_SESSION['user'];
    $btnText = "Profiel bewerken";
    $btnClass = "btnEditProfile";
   $bioText = $_SESSION['bio'];
    $avatar = $_SESSION['avatar'];
    $userID = $_SESSION['userID'];
}
// get feed:
// users -> getFeed(userID);
$conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
    $statement = $conn->prepare("select * from posts where imageUserID = :userID order by timestamp desc");
    $statement->bindValue(':userID', $userID);
    $statement->execute();
    $results = $statement->fetchAll();

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
                <li><span>9</span> posts</li>
                <li><span>20</span> followers</li>
                <li><span>25</span> following</li>
            </ul>

        </div>

    </div>

    <main class="feedContainer">

        <div class="profileFeed">
            <?php foreach($results as $post): ?>
            <div class="feedPic">
               <img src="<?php echo $post['fileLocation']; ?>" alt="">
                </div>
                <?php endforeach; ?>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>