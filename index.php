<?php
    include_once('includes/no-session.inc.php');

    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select * from posts order by timestamp desc");
        $statement->execute();
        $rows_found = $statement->rowCount();
        echo $rows_found;
        $results = $statement->fetchAll();
    
?>
<!doctype html>
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
            <?php foreach($results as $post): ?>
            <li><img src="<?php echo $post['fileLocation']; ?>" alt=""></li>
            <?php endforeach; ?>
        <ul>
               
        </ul>

    </div>
    
        <a href="upload.php" id="floatingBtn">+</a>
    <!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>