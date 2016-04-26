<?php
include_once('includes/no-session.inc.php');


// checken wiens account geladen moet worden
if(!empty($_GET)){
    $userID = $_GET['userID'];
    // select * from users where $userID = $_GET['userID']
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
    $getProfile = $conn->prepare("select userID, username, password, bio, avatar from users where userID = :userID");
    $getProfile->bindValue(':userID', $userID);
    $getProfile->execute();
    $profileInfo = $getProfile->fetch(PDO::FETCH_ASSOC);
    // knop: volgen -> insert into follows
    $bioText = $profileInfo['bio'];
    $username = $profileInfo['username'];
    $btnText = "Volgen";
    $avatar = $profileInfo['avatar'];
}
else {
    // alle profielinfo zit in $_SESSION
    // knop: profiel bewerken -> editProfile.php
    // follows: info uit tabel 'follows'
   $username = $_SESSION['user'];
    $btnText = "Profiel bewerken";
   $bioText = $_SESSION['bio'];
    $avatar = $_SESSION['avatar'];
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

                <a href="editProfile.php"><button class="btnEditProfile"><?php echo $btnText; ?></button></a>
            </div>

            <p class="userDescription"><?php echo $bioText; ?></p>

            <ul class="userStats">
                <li><span>9</span> posts</li>
                <li><span>20</span> followers</li>
                <li><span>25</span> following</li>
            </ul>

        </div>

    </div>

    <div class="profileFeed">

        <ul>
            <?php foreach($results as $post): ?>
            <li><img src="<?php echo $post['fileLocation']; ?>" alt=""></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>