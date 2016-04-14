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
        }
    }

    public function Register(){
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

    public function canLogin(){

        $p_password = $this->Password;

        $conn = new mysqli("localhost", "root", "root", "imdstagram");
        $sql = "select username, password from users where username = '".$this->Username."'";
        $result = $conn->query($sql);

        if($result->num_rows == 1)
        {
            $user = $result->fetch_assoc();
            $hash = $user['password'];

            if ( password_verify($p_password, $hash)) {
                return true;
;           }
            else
            {
                return false;
            }
        }
    }

    public function updateProfile(){
        $currentUser = $_SESSION['user'];

        $conn = new mysqli("localhost", "root", "root", "imdstagram");
        $sqlUpdate = "update users set username = '".$this->EditUsername."', email = '".$this->EditEmail."',
                           bio = '".$this->EditBio."' where username = '".$currentUser."'";
        $sqlUpdate = $conn->query($sqlUpdate);

        $_SESSION['user'] = $this->EditUsername;
    }

}