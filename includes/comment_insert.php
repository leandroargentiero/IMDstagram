<?php

    session_start();
    include_once ("database.inc.php");

    //userID
    //commentID
    $commentUserID = $_SESSION['userID'];
    $commentImageID = $_POST['imageID'];

    $statement = $conn->prepare("INSERT INTO comments(commentUserID, commentImageID, commentText)
                                  VALUES(:commentUserID, :commentImageID, :commentInsert())");
    $statement->bindValue(':commentUserID',$commentUserID);
    $statement->bindValue(':commentImageID', $commentImageID);
    $statement->bindValue(':commentText', commentInsert());
    $statement->execute();




?>