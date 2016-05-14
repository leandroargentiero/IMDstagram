<?php
include_once ("database.inc.php");

if($_POST)
{
    $username = strip_tags($_POST['editUsername']);

    $sql = "select username from users where username = '".$username."'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();

    if($count>0)
    {
        echo "<span style='color:#FE3554;'>Username already in use</span>";
    }
    else
    {
        echo "<span style='color:#00D062;'>Available</span>";
    }
}