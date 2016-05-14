<?php
session_start();
include_once ("database.inc.php");

// likeImageID
if(!empty($_SESSION['postDetailimageID']))
{
    $_SESSION['feedImageID'] = "";
    $likeImageID = $_SESSION['postDetailimageID'];
}
elseif(!empty($_SESSION['feedImageID']))
{
    $_SESSION['postDetailimageID'] = "";
    $likeImageID = $_SESSION['feedImageID'];
}
//$likeImageID = $_SESSION['imageID'];
// likeSenderID
$likeSenderID = $_SESSION['userID'];

$deleteLike = $conn->prepare("DELETE FROM likes
                              WHERE likeImageID = $likeImageID AND likeSenderID = $likeSenderID");
$deleteLike->execute();