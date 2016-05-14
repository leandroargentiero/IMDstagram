<?php 
    session_start();
    include_once ("database.inc.php");
    
    $userID = $_SESSION['userID'];
    $makePrivate = $conn->prepare('UPDATE users SET private = "yes" WHERE userID = :userID');

    $makePrivate->bindValue(':userID', $userID);
    $makePrivate->execute();
    echo "private";
    

?>