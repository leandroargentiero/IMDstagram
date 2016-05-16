<?php
if(!isset($_SESSION)){session_start();}
include_once ("database.inc.php");
    //userID
    $commentUserID = $_POST['userID'];
    //commentID
    $commentImageID = $_POST['imageID'];
    //newComment
    if(isset($_POST['newComment'])){
        $commentText = $_POST['newComment'];
    }

    if(!empty($commentText)) {
        $statement = $conn->prepare("INSERT INTO comments (commentUserID, commentImageID, commentText)
                                  VALUES (:commentUserID, :commentImageID, :commentText)");
        $statement->bindValue(':commentUserID',$commentUserID);
        $statement->bindValue(':commentImageID', $commentImageID);
        $statement->bindValue(':commentText', $commentText);
        $statement->execute();
    }
?>