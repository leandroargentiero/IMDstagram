<?php

/**
 * Created by PhpStorm.
 * User: Leandro
 * Date: 04/04/16
 * Time: 18:53
 */
class Users{
    private $m_sEmail;
    private $m_sFullname;
    private $m_sUsername;
    private $m_sPassword;
    private $m_sEditEmail;
    private $m_sEditUsername;
    private $m_sEditBio;
    private $m_sEditPassword;
    private $m_sfilePath;

    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty){
            case "Email":
                $this->m_sEmail = $p_vValue;
                break;
            case "Fullname":
                $this->m_sFullname = $p_vValue;
                break;
            case "Username":
                $this->m_sUsername = $p_vValue;
                break;
            case "Password":
                $this->m_sPassword = $p_vValue;
                break;
            case "EditEmail":
                $this->m_sEditEmail = $p_vValue;
                break;
            case "EditUsername":
                $this->m_sEditUsername = $p_vValue;
                break;
            case "EditBio":
                $this->m_sEditBio = $p_vValue;
                break;
            case "EditPassword":
                $this->m_sEditPassword = $p_vValue;
                break;
            case "Image":
                $this->m_sfilePath = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch($p_sProperty){
            case "Email":
                return $this->m_sEmail;
                break;
            case "Fullname":
                return $this->m_sFullname;
                break;
            case "Username":
                return $this->m_sUsername;
                break;
            case "Password":
                return $this->m_sPassword;
                break;
            case "EditEmail":
                return $this->m_sEditEmail;
                break;
            case "EditUsername":
                return $this->m_sEditUsername;
                break;
            case "EditBio":
                return $this->m_sEditBio;
                break;
            case "EditPassword":
                return $this->m_sEditPassword;
                break;
            case "Image":
                return $this->m_sfilePath;
                break;
        }
    }

    public function Register()
    {
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("insert into users (email, fullname, username, password) values (:email, :fullname,
                                                        :username, :password)");
        $statement->bindValue(":email", $this->Email);
        $statement->bindValue(":fullname", $this->Fullname);
        $statement->bindValue(":username", $this->Username);
        // password options
        $options = [
            'cost'=> 12
        ];
        // bcrypting password
        $password = password_hash($this->Password, PASSWORD_DEFAULT, $options);
        $statement->bindValue(":password", $password);
        $statement->execute();
    }

    public function canLogin()
    {
        $p_password = $this->Password;
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $sql = "select userID, username, password from users where username = '".$this->Username."'";
        $statement = $conn->prepare($sql);
        $statement->execute();

        if($statement->rowCount() == 1)
        {
            $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
            $hash = $currentUser['password'];
            $_SESSION['userID'] = $currentUser['userID'];


            if ( password_verify($p_password, $hash)) {
                return true;
           }
            else
            {
                return false;
            }
        }
    }

    public function updateProfile()
    {
        $currentUser = $_SESSION['user'];
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');

        $sqlUpdate =
            "UPDATE users
                SET username = (case when '".$this->EditUsername."' = '' then username else '".$this->EditUsername."' end),
                    email = (case when '".$this->EditEmail."' = '' then email else '".$this->EditEmail."' end),
                    bio = (case when '".$this->EditBio."' = '' then bio else '".$this->EditBio."' end)
                WHERE
                    username = '".$currentUser."';
            ";

        $statementUpdate = $conn->prepare(($sqlUpdate));
        $statementUpdate->execute();

        if(strlen(trim($this->EditUsername)) != 0)
        {
            $_SESSION['user'] = $this->EditUsername;
        }

    }

    public function updatePassword()
    {
        $currentUser = $_SESSION['user'];

        // password options
        $options = [
            'cost'=> 12
        ];
        // bcrypting new password
        $password = password_hash($this->EditPassword, PASSWORD_DEFAULT, $options);

        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $sqlUpdatePassword = "update users set password = '".$password."' where username = '".$currentUser."'";
        $statement = $conn->prepare($sqlUpdatePassword);
        $statement->execute();
    }

    public function moveAvatar() {
        // Tijdelijke locatie van de upload opvragen
        $filename = $_FILES["file"]["tmp_name"];
        // checken of het wel degelijk een afbeelding is.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);
        // nieuwe locatie en filename aanmaken
        // files/userID_timestamp.jpg
        $m_sfilePath = "files/" . $_SESSION['userID'] . "_avatar.jpg";
        // functie om de file te moven
        move_uploaded_file($_FILES["file"]["tmp_name"], $m_sfilePath);
        // nieuwe locatie opslaan in variabele voor de query
        $this->m_sfilePath = $m_sfilePath;
    }

    public function saveAvatar()
    {
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("update users set avatar = :avatar where userID = '".$_SESSION['userID']."'");
        $statement->bindValue(":avatar", $this->m_sfilePath);
        $statement->execute();

        $_SESSION['avatar'] = $this->m_sfilePath;
    }

    public function showAvatar()
    {
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select avatar from users where userID = '".$_SESSION['userID']."'");
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['avatar'] = $result['avatar'];
        }
    }

}