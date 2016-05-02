<?php
include_once('includes/no-session.inc.php');
include_once('includes/database.inc.php');

    if(isset($_GET['txtSearch'])) {
        $searchKeyword = $_GET['txtSearch'];
        $results = array();
        $statement = $conn->prepare("SELECT *
                      FROM posts
                      WHERE description
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
</head>
<style>
    .feedback{
        font-family: 'instaRegular', 'sans-serif';
        text-align: center;
    }
    .errorMessage{
        color: #FE3554;
        margin: 20px 0 20px 0;
    }
    .searchKeywords{
        margin: 0px 0px 10px 0;
        font-size: 1.5em;
    }
    .countPosts{
        margin: 0px 0px 20px 0;
    }
    span{
        font-family: 'instaBold', 'sans-serif';
    }
    .posts{
        object-fit: cover;
    }
</style>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div class="profileFeed">
    <h1 class="feedback errorMessage"><?php if(isset($errorMessage)){ echo $errorMessage;} ?></h1>

    <h2 class="feedback searchKeywords"><?php if(isset($countPosts)){echo $_GET['txtSearch'];} ?></h2>
    <h3 class="feedback countPosts"><?php if(isset($countPosts)){echo "<span>".$countPosts."</span>"." posts";} ?></h3>
    <ul>
        <?php foreach($results as $result): ?>
            <li><a href="postDetail.php?imageID=<?php echo $result['imageID']; ?>"><img class="posts" src="<?php echo $result['fileLocation']; ?>" alt="post"></a></li>
        <?php endforeach;?>
    </ul>

</div>

<a href="upload.php" id="floatingBtn">+</a>
<!--<a href="includes/logout.inc.php">logout</a>-->
</body>
</html>