<?php 
session_start();
$conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
if(!empty($_SESSION['targetUserID'])){
    $requestUserID = $_SESSION['userID'];
    $targetUserID = $_SESSION['targetUserID'];
    $statement = $conn->prepare('delete from follows where requestUserID = :requestUserID and targetUserID = :targetUserID');
    $statement->bindValue(':requestUserID', $requestUserID);
    $statement->bindValue(':targetUserID', $targetUserID);
    $statement->execute();
    if($statement->execute()){
        console.log("send");
        echo "unfollowed";
    };
}
?>