<div class="headerProfile">
    <div class="headerContent">
        <a href="index.php"><img src="images/logo.png" alt="logo"></a>
        <div class="searchBar">
            <form name="formSearch" method="get" action="search.php">
                <span><input id="txtSearch" type="text" name="txtSearch" placeholder="Search" required></span>
            </form>
        </div>
        <a class="headerUsername" href="profile.php"><h2><?php echo $_SESSION['user']; ?></h2>
        </a><span id="notificationIcon"class="glyphicon glyphicon-bell"></span>
         <a href="includes/logout.inc.php">logout</a>
    </div>
</div>
