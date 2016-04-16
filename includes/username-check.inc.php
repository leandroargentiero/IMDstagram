<?php
/**
 * Created by PhpStorm.
 * User: Leandro
 * Date: 16/04/16
 * Time: 18:01
 */
$conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');

if($_POST)
{
    $username = strip_tags($_POST['editUsername']);

    $sql = "select username from users where username = '".$username."'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();

    if($count>0)
    {
        echo "<span style='color:#FE3554;'>Sorry, username already taken.</span>";
    }
    else
    {
        echo "<span style='color:#00D062;'>available</span>";
    }
}