<?php
    include_once("database.inc.php");
    session_start();
    
    
    
    $userID = $_SESSION['userID'];
    $imageID = $_SESSION['imageID'];
    
    
    $statement = $conn->prepare("delete from posts where imageID = :imageID and imageUserID = :userID");

    $statement->bindValue(":imageID", $imageID);
    $statement->bindValue(":userID", $userID);
    $statement->execute();
    
    
    echo "ok";
?>
        