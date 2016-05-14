<?php 
    session_start();
    include_once('database.inc.php');
    $requestUserID = $_POST['aanvraag'];
    $targetUserID = $_SESSION['userID'];
    
    
    // request goedgekeurd, dus mag weg uit request table
    $acceptFollow = $conn->prepare('delete from followrequests where requestUserID = :requestUserID and targetUserID = :targetUserID');
    $acceptFollow->bindValue(':requestUserID', $requestUserID);
    $acceptFollow->bindValue(':targetUserID', $targetUserID);
    $acceptFollow->execute();
    
    // follow insert in de follow table
    $follow = $conn->prepare('insert into follows (requestUserID, targetUserID) values (:requestUserID, :targetUserID)');
    $follow->bindValue(':requestUserID', $requestUserID);
    $follow->bindValue(':targetUserID', $targetUserID);
    $follow->execute();
?>