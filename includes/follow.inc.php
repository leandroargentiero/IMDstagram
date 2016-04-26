<?php 
session_start();
$conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');

if(!empty($_SESSION['targetUserID'])){
    $requestUserID = $_SESSION['userID'];
    $targetUserID = $_SESSION['targetUserID'];
    console.log($requestUserID);
    console.log($targetUserID);
    $statement = $conn->prepare('insert into follows (requestUserID, targetUserID) values (:requestUserID, :targetUserID)');
    $statement->bindValue(':requestUserID', $requestUserID);
    $statement->bindValue(':targetUserID', $targetUserID);
    $statement->execute();
    if($statement->execute()){
        console.log("send");
        echo "followed";
    };
}
?>