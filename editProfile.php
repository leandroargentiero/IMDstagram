<?php
    include_once('includes/no-session.inc.php');
    include_once ("classes/users.class.php");

    if(!empty($_POST)){
        $editEmail = $_POST['editEmail'];
        $editUsername = $_POST['editUsername'];
        $editBio = $_POST['editBio'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        if(strlen(trim($editEmail)) != 0)
        {
            $updateEmail = new Users();
            $updateEmail->EditEmail = $editEmail;
            $updateEmail->updateEmail();

            $messageDetails = "Je gegevens werden succesvol gewijzigd.";
        }
        elseif(strlen(trim($editUsername)) != 0)
        {
            $updateUsername = new Users();
            $updateUsername->EditUsername = $editUsername;
            $updateUsername->updateUsername();

            $messageDetails = "Je gegevens werden succesvol gewijzigd.";
        }
        elseif(strlen(trim($editBio)) != 0)
        {
            $updateBio = new Users();
            $updateBio->EditBio = $editBio;
            $updateBio->updateBio();

            $messageDetails = "Je gegevens werden succesvol gewijzigd.";
        }
        else if(strlen(trim($newPassword)) != 0 and strlen(trim($confirmNewPassword)) != 0)
        {
            if(strcmp($newPassword, $confirmNewPassword) == 0){
                $updatePassword = new Users();
                $updatePassword->EditPassword = $confirmNewPassword;
                $updatePassword->updatePassword();

                $passwordSucces = "Jouw wachtwoord werd succesvol gewijzigd.";
            }
            else
            {
                $passwordError = "Woops, wachtwoorden komen niet overeen. Probeer opnieuw!";
            }
        }
        else
        {
            $messageEmptySubmit = "Gelieve een veld in te vullen om te kunnen wijzigen.";
        }

    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
    <style>
        .editContainer {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        .editContainer h1 {
            color: #06365F;
            font-family: 'instaRegular', 'sans-serif';
            font-size: 1.3em;
            margin-bottom: 15px;
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dddbd9;

        }

        .editContainer form {
            margin-bottom: 50px;
        }

        .editContainer label {
            width: 150px;
            display: inline-block;
            font-size: 0.8em;

        }

        .editContainer input {
            margin-bottom: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #dddbd9;
        }

        .formDetails select, textarea {
            margin-bottom: 10px;
            border-radius: 5px;
            width: 250px;
            border: 1px solid #dddbd9;
        }

        .formDetails textarea {
            vertical-align: top;
        }
        .messageUpdate{
            font-family: 'instaLight', sans-serif;
            background-color: #00D062;
            font-size: .7em;
            color: white;
            padding: 1em;
            width: 43%;
            border-radius: 5px;
        }
        .error{
            background-color: #FE3554;
        }
        #availability{
            display: block;
            font-size: .7em;
            margin: -10px 0 10px 0;
        }
    </style>
</head>
<body>
    <?php include_once("includes/nav.inc.php"); ?>

    <div class="editContainer">
        <div class="editDetails">
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
                    if( isset($messageDetails) ) {
                    echo "<p class='messageUpdate'>$messageDetails</p>";
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
                    echo "<p class='messageUpdate error'>$passwordError</p>";
                }
                else if( isset($messageEmptySubmit) )
                {
                    echo "<p class='messageUpdate error'>$messageEmptySubmit</p>";
                }
                ?>

                <input class="submitEdit" type="submit" value="Gegevens wijzigen">
            </form>

        </div>
    </div>
</body>
</html>