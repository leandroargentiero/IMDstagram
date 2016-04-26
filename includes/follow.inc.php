<?php 
session_start();
$conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');

if($_POST){
    $requestUserID = $_SESSION['userID'];
    $targetUserID = $_SESSION['targetUserID'];
    
    $statement = $conn->prepare('insert into follows (requestUserID, targetUserID) values (:requestUserID, :targetUserID)');
    $statement->bindValue(':requestUserID', $requestUserID);
    $statement->bindValue(':targetUserID', $targetUserID);
    $statement->execute();
}
?>