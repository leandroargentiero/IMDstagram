<?php
include_once('includes/no-session.inc.php');


// checken wiens account geladen moet worden
if(!empty($_GET)){
    // select * from users where $userID = $_GET['userID']
    // knop: volgen -> insert into follows
   $username = $_GET['user'];
    $btnText = "Volgen";
}
else {
    // alle profielinfo zit in $_SESSION
    // knop: profiel bewerken -> editProfile.php
    // follows: info uit tabel 'follows'
   $username = $_SESSION['user'];
    $btnText = "Profiel bewerken";
}
// get feed:
// users -> getFeed(userID);


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
        <img class="profilePhoto" src="<?php echo $_SESSION['avatar']; ?>" alt="profile photo">
        <div class="profileDetails">
            <div class="editProfile">
                <p class="userName"><?php echo $username; ?></p>

                <a href="editProfile.php"><button class="btnEditProfile"><?php echo $btnText; ?></button></a>
            </div>

            <p class="userDescription">25 year old - IMD student - Leuven</p>

            <ul class="userStats">
                <li><span>9</span> posts</li>
                <li><span>20</span> followers</li>
                <li><span>25</span> following</li>
            </ul>

        </div>

    </div>

    <div class="profileFeed">

        <ul>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
            <li><img src="images/m8.jpg" alt="post"></li>
        </ul>
    </div>
</body>
</html>