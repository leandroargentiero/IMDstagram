<?php
include_once('includes/no-session.inc.php');

    if(isset($_GET['txtSearch'])) {
        $searchQ = $_GET['txtSearch'];
        $results = array();
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("SELECT *
                      FROM posts
                      WHERE description
                      LIKE :keywords;");
        $statement->bindValue(':keywords', '%' . $searchQ . '%');
        $statement->execute();

        if($statement->rowCount() >= 1){
            $results = $statement->fetchAll();
        }
        else
        {
            $errorMessage = "Helaas, we vonden geen foto's die matchen met de zoekterm: ".$_GET['txtSearch'];
        }

    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UT F-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div class="profileFeed">
    <h1>
        <?php
            if(isset($errorMessage)){
                echo $errorMessage;
            }
        ?>
    </h1>
    <ul>
        <?php foreach($results as $result): ?>
            <li><img src="<?php echo $result['fileLocation']; ?>" alt="post"></li>
        <?php endforeach;?>
        <li><img src="images/m8.jpg" alt="post"></li>
    </ul>

</div>

<a href="upload.php" id="floatingBtn">+</a>
<!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>