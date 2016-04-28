<?php
    include_once('includes/no-session.inc.php');

    // - Eerst zien wie de user volgt
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select targetUserID from follows where requestUserID = :requestUserID");
        $statement->bindValue(":requestUserID", $_SESSION['userID']);
        $statement->execute();
        $rows_found = $statement->rowCount();
        $results = $statement->fetchAll();

    
    
    // gevonden users in een array stoppen voor de select
    $array = array();

    // eigen foto's niet vergeten.
    array_push($array, $_SESSION['userID']);
    foreach($results as $entry){ 
        array_push($array, $entry['targetUserID']);
    }
    
    // array 'plat' maken voor de select.
    $csa = implode(", ",$array);

    // selecteren
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare('select * from posts where imageUserID in (:array) order by timestamp desc limit 20');
        $statement->bindValue(":array", $csa);
        $statement->execute();
        
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

    
    
    <div class="indexFeed">
            <?php foreach($results as $post): ?>
            <div class="feedPic">
               <img src="<?php echo $post['fileLocation']; ?>" alt="">
                </div>
                <?php endforeach; ?>
        </div>
    
        <a href="upload.php" id="floatingBtn">+</a>
    <!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>