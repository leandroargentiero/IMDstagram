<?php
    include_once("database.inc.php");
    session_start();
    
    
    
    $userID = $_SESSION['userID'];
    $imageID = $_SESSION['imageID'];
    
    
    $statement = $conn->prepare("delete from posts where imageID = :imageID");

    $statement->bindValue(":imageID", $imageID);
    $statement->execute();
    
    
    echo "ok";
?>
        