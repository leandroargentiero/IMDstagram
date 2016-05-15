<?php 
session_start();
include_once('database.inc.php');
if(!empty($_SESSION['targetUserID'])){
    $requestUserID = $_SESSION['userID'];
    $targetUserID = $_SESSION['targetUserID'];
    $statement = $conn->prepare('delete from followrequests where requestUserID = :requestUserID and targetUserID = :targetUserID');
    $statement->bindValue(':requestUserID', $requestUserID);
    $statement->bindValue(':targetUserID', $targetUserID);
    $statement->execute();
    if($statement->execute()){
        console.log("send");
        echo "canceled";
    };
}
?>