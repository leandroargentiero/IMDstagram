<?php 
    session_start();
    include_once('classes/users.class.php');
    include_once('classes/feed.class.php');
    include_once('classes/notifications.class.php');

    $userID = $_SESSION['userID'];
    
    // follows en profielinfo ophalen
    $profile = new Users();
    $profile->getProfile($userID);
    $profile->getFollowCount($userID);
    $profile->getFollowerCount($userID);
    
    $username = $profile->Username;
    $bioText = $profile->Bio;
    $avatar = $profile->Image;
    
    
    $notifications = new Notification();
    
    $notifications->getFollowRequests($userID);

    $profileInfo = new Users();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instagram - Notifications</title>
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

                <button id="" class="btnEditProfile">Profiel bewerken</button>
            </div>

            <p class="userDescription"><?php echo $bioText; ?></p>

            <ul class="userStats">
                <li><span><?php echo $feed->PostCount; ?></span> posts</li>
                <li><span><?php echo $profile->FollowerCount; ?></span> followers</li>
                <li><span><?php echo $profile->FollowCount; ?></span> following</li>
            </ul>

        </div>

    </div>
    
    
    <h1 id="notifTitle"><?php echo $notifications->NotifCount; ?> Notifications</h1>
    
    <?php foreach($notifications->Results as $notification): ?>
            
              <div class="notifList">
                    <img src="<?php $profileInfo->getProfile($notification['requestUserID']); 
                      echo $profileInfo->Image; ?> " alt="" class="profilePhoto">
                   
                    <a href="profile.php?userID=<?php echo $notification['requestUserID']; ;?>">
                      <?php 
                      
                      $profileInfo->getProfile($notification['requestUserID']); 
                      echo $profileInfo->Username; 
                        
                      ?>
                    </a> wil je volgen. 
                    <span class="glyphicon glyphicon-ok" value="<?php $notification['requestUserID']; ?>"></span>
                    <span class="glyphicon glyphicon-remove" value="<?php $notification['requestUserID']; ?>"></span>
              </div>
            
    <?php endforeach; ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>