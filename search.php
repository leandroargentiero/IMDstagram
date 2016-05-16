<?php
include_once('includes/no-session.inc.php');
include_once('includes/database.inc.php');
include_once('classes/postDetail.class.php');

    if(isset($_GET['txtSearch'])) {
        $searchKeyword = $_GET['txtSearch'];
        $results = array();
        $statement = $conn->prepare("SELECT *
                      FROM posts
                      WHERE description
                      LIKE :keywords
                      OR
                      location
                      LIKE :keywords
                      ORDER BY timestamp DESC");
        $statement->bindValue(':keywords', '%' . $searchKeyword . '%');
        $statement->execute();

        if($statement->rowCount() >= 1){
            $results = $statement->fetchAll();
            $countPosts = $statement->rowCount();
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
    <link rel="stylesheet" href="css/cssgram.min.css">
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div class="searchFeed">
    <h1 class="feedback errorMessage"><?php if(isset($errorMessage)){ echo $errorMessage;} ?></h1>

    <h2 class="feedback searchKeywords"><?php if(isset($countPosts)){echo $_GET['txtSearch'];} ?></h2>
    <h3 class="feedback countPosts"><?php if(isset($countPosts)){echo "<span>".$countPosts."</span>"." posts";} ?></h3>
    <div class="searchResults">
        <?php foreach($results as $result): ?>
            <a href="postDetail.php?imageID=<?php echo $result['imageID']; ?>">
                <div class="feedBox">
                    <figure class="<?php echo $result['filter']; ?>">
                        <img src="<?php echo $result['fileLocation']; ?>" alt="">
                    </figure>
                     <div class="overlay">
                        <div class="likes">
                            <img class="overlay-icon"src="images/white_heart.png" alt="">
                            <p>
                                <?php
                                $likes = new postDetail();
                                $likecount = $likes->getLikes($result['imageID']);
                                echo $likecount;
                                ?>
                            </p>
                        </div>
                        <div class="comments">
                            <img class="overlay-icon" src="images/comments.png" alt="">
                            <p>
                                <?php
                                    $comments = new postDetail();
                                    $commentCount = $comments->countComments($result['imageID']);
                                    echo $commentCount;
                                ?>
                            </p>
                        </div>
                     </div>
                </div>
            </a>
        <?php endforeach;?>
    </div>
</div>

<a href="upload.php" id="floatingBtn">+</a>
<!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>