<?php
include_once('includes/no-session.inc.php');
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .editContainer {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        .editContainer h1 {
            color: #06365F;
            font-family: 'instaRegular';
            font-size: 1.3em;
            margin-bottom: 15px;
            margin-top: 30px;

        }

        .editContainer form {
            border-top: 1px solid #dddbd9;
            border-bottom: 1px solid #dddbd9;
            padding-top: 10px;
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
            border: 1px solid #dddbd9;
        }

        .formDetails textarea {
            vertical-align: top;
        }



    </style>
</head>
<body>
    <?php include_once("includes/nav.inc.php"); ?>

    <div class="editContainer">
        <div class="editDetails">
            <h1>Profiel bewerken</h1>

            <form class="formDetails" action="">
                <label for="name">Naam:</label>
                <input type="text" name="name"></br>

                <label for="email">E-mailadres:</label>
                <input type="email" name="email"></br>

                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username"></br>

                <select name="gender" id="">
                    <option value="male">Man</option>
                    <option value="female">Vrouw</option>
                </select></br>

                <label for="bio">Biografie:</label>
                <textarea name="bio" id="" cols="30" rows="10"></textarea></br>

                <input class="submitEdit" type="submit" value="Verzenden">

            </form>

        </div>

        <div class="editPassword">
            <h1>Wachtwoord wijzigen</h1>

            <form class="formPassword" action="">
                <label for="oldpassword">Oud wachtwoord:</label>
                <input type="password" name="oldpassword"></br>

                <label for="newpassword">Nieuw wachtwoord:</label>
                <input type="password" name="newpassword"></br>

                <label for="confirmnewpassword">Nieuw wachtwoord bevestigen:</label>
                <input type="password" name="confirmnewpassword"></br>

                <input class="submitEdit" type="submit" value="Wachtwoord wijzigen">



            </form>

        </div>

    </div>



</body>
</html>