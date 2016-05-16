<?php


include_once ("database.inc.php");


    
    //userID
    //commentID
    $commentUserID = $_SESSION['userID'];
    $commentImageID = $_SESSION['imageID'];
    $commentText = $_POST['newComment'];

    if(!empty($commentText)) {
        $statement = $conn->prepare("INSERT INTO comments (commentUserID, commentImageID, commentText)
                                  VALUES (:commentUserID, :commentImageID, :commentText)");
        $statement->bindValue(':commentUserID',$commentUserID);
        $statement->bindValue(':commentImageID', $commentImageID);
        $statement->bindValue(':commentText', $commentText);
        $statement->execute();

    }




    

?>