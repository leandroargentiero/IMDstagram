<?php
    include_once('includes/no-session.inc.php');
    include_once ("classes/users.class.php");

    $showavatar = new Users();
    $showavatar->showAvatar();

    if(!empty($_POST)){
        if(isset($_POST['update'])){
            $editEmail = strip_tags($_POST['editEmail']);
            $editUsername = strip_tags($_POST['editUsername']);
            $editBio = strip_tags($_POST['editBio']);
            $_SESSION['bio'] = strip_tags($_POST['editBio']);
            $newPassword = strip_tags($_POST['newPassword']);
            $confirmNewPassword = strip_tags($_POST['confirmNewPassword']);

            if(strlen(trim($editEmail)) != 0 or strlen(trim($editUsername)) != 0 or strlen(trim($editBio)) != 0)
            {
                $updateProfile = new Users();
                $updateProfile->EditEmail = $editEmail;
                if(!empty($editUsername))
                {
                    $updateProfile->EditUsername = $editUsername;
                }
                $updateProfile->EditBio = $editBio;
                $updateProfile->updateProfile();

                $messageUpdate = "Your information was successfully updated.";

            }
            else
            {
                $messageEmptySubmit = "We could not change your information. Try again!";
            }

            if(strlen(trim($newPassword)) != 0 and strlen(trim($confirmNewPassword)) != 0)
            {
                if(strcmp($newPassword, $confirmNewPassword) == 0){
                    $updatePassword = new Users();
                    $updatePassword->EditPassword = $confirmNewPassword;
                    $updatePassword->updatePassword();
                    
                    $passwordSucces = "Your password was successfully changed.";
                }
                else
                {
                    $passwordError = "Woops, passwords do not match. Try again!";
                }
            }
        }

        if(isset($_POST['upload'])){
            if ($_FILES["file"]["error"] > 0)
            {
            //for error messages: see http://php.net/manual/en/features.fileupload.errors.php
                switch($_FILES["file"]["error"])
                {
                    case 1:
                        $errorImage = "We are sorry. Your file is too big(Max. 2mb)";
                        break;
                    default:
                        $errorImage = "Woops, uploading failed.";
                }
            }
            else
            {
                $p = new Users();
                $p->moveAvatar();
                $p->saveAvatar();
            }
        }
    }

    // PRIVACY SETTINGS

    $privacySetting = "Public";
    $privacyUitleg = "This means that anyone can see your posts.";

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#username").keyup(function()
            {
                var username = $(this).val();

                if(username.length > 2)
                {
                    $("#availability").html('checking...');

                    $.ajax({
                        type : 'POST',
                        url  : 'includes/username-check.inc.php',
                        data : $(this).serialize(),
                        success : function(data)
                        {
                            $("#availability").html(data);
                        }
                    });
                    return false;

                }
                else
                {
                    $("#availability").html('');
                }
            });

        });
    </script>
</head>
<body>
    <?php include_once("includes/nav.inc.php"); ?>

    <div class="editContainer">
        <div class="editDetails">
            <h1>Avatar uploaden</h1>
            <img class="avatar" src="<?php echo $_SESSION['avatar']; ?>" alt="avatar">

            <form class="formUpload" action="" enctype="multipart/form-data" method="post">
                <label for="file">Avatar uploaden:</label>
                <input type="file" name="file" id="file">
                <?php
                if( isset($errorImage) ) {
                    echo "<p class='messageUpdateError'>$errorImage</p>";
                }
                ?>

                <input class="btnUpload" type="submit" name="upload" value="Upload">
            </form>

            <h1>Profiel bewerken</h1>

            <form class="formDetails formPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="email">E-mailadres:</label>
                <input type="email" name="editEmail"></br>

                <label for="username">Gebruikersnaam:</label>
                <input id="username" type="text" name="editUsername"></br>
                <span id="availability"></span>

                <label for="bio">Biografie:</label>
                <textarea name="editBio" maxlength="150" id="bio" cols="30" rows="5"></textarea></br>

                <?php
                    if( isset($messageUpdate) ) {
                    echo "<p class='messageUpdate'>$messageUpdate</p>";
                    }
                ?>

                <h1>Wachtwoord wijzigen</h1>

                <label for="newpassword">Nieuw wachtwoord:</label>
                <input type="password" name="newPassword"></br>

                <label for="confirmnewpassword">Nieuw wachtwoord bevestigen:</label>
                <input type="password" name="confirmNewPassword"></br>

                <?php
                if( isset($passwordSucces) )
                {
                    echo "<p class='messageUpdate'>$passwordSucces</p>";
                }
                else if( isset($passwordError) )
                {
                    echo "<p class='messageUpdateError'>$passwordError</p>";
                }
                else if( isset($messageEmptySubmit) )
                {
                    echo "<p class='messageUpdateError'>$messageEmptySubmit</p>";
                }
                ?>
                
                <input class="submitEdit" name="update" type="submit" value="Gegevens wijzigen">
            </form>
            <h1>Privacy</h1>
            <button class="<?php echo $privacySetting; ?>"><?php echo $privacySetting; ?></button>
            <p>Your profile is:  <strong id="privacySetting"><?php echo $privacySetting; ?></strong>.</p>
             
            <p id="privacyUitleg"> <?php echo $privacyUitleg; ?></p>
            

        </div>
    </div>
</body>
</html>