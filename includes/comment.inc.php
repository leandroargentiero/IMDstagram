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




/*
  Normaal gezien komt uw comment nu in de databank terecht.
  Wat gij nu nog gaat moeten uitdokteren:
  -comment appenden in die list met de juiste username, dus zodat dat vanaf eender welke account lukt
  (ge kunt dat bv doen door uw $_SESSION['userID'] als value ergens in uw pagina te zetten.
  Dan kunt ge via jquery die value oproepen voor uwe append
 *
 */
    

?>