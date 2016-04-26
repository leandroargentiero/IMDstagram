<?php
    session_start();
    include_once ("includes/nav.inc.php");

    if(isset($_GET['imageID'])){
        $imageID = $_GET['imageID'];
        $result = array();

        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("
                            SELECT *
                            FROM posts
                            WHERE imageID = :imageID");
        $statement->bindValue(':imageID', $imageID );
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .postDetail{
        background-color: grey;
        width: 800px;
        height: 400px;
        margin: 100px auto 0 auto;
        display: flex;
    }
    .innerLeft{
        width: 400px;
        height: 400px;
    }
    .innerLeft img{
        width: 100%;
        height: 100%;
        background-color: gold;
    }
    .innerRight{
        width: 400px;
        height: 400px;
        background-color: red;
    }

</style>
<body>
    <div class="postDetail">
        <div class="innerLeft"><img src="<?php echo $result['fileLocation']; ?>" alt=""></div>
        <div class="innerRight"></div>
    </div>
</body>
</html>