<?php 
session_start();
include_once('database.inc.php');

if(!empty($_SESSION['targetUserID'])){
    $requestUserID = $_SESSION['userID'];
    $targetUserID = $_SESSION['targetUserID'];
    $statement = $conn->prepare('insert into follows (requestUserID, targetUserID) values (:requestUserID, :targetUserID)');
    $statement->bindValue(':requestUserID', $requestUserID);
    $statement->bindValue(':targetUserID', $targetUserID);
    if($statement->execute()){
        console.log("send");
        echo "followed";
    };
}
?>