<?php
include_once('includes/no-session.inc.php');
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
        <img class="profilePhoto" src="images/profile.jpg" alt="profile photo">
        <div class="profileDetails">
            <div class="editProfile">
                <p class="userName">kennymn</p>

                <button class="btnEditProfile"> Profiel bewerken</button>
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