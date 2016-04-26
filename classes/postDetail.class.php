<?php
/**
 * Created by PhpStorm.
 * User: Leandro
 * Date: 26/04/16
 * Time: 15:33
 */
class postDetail{
    private $m_iImageID;

    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty) {
            case "imageID":
                $this->m_iImageID = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
            case "imageID":
                return $this->m_iImageID;
                break;
        }
    }

    public function getImage(){
        $result = array();

        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("
                                    SELECT *
                                    FROM posts
                                    WHERE imageID = :imageID");
        $statement->bindValue(':imageID', $this->m_iImageID );
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getAvatar(){
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $getUserID = $conn->prepare("
                                    SELECT imageUserID
                                    FROM posts
                                    WHERE imageID = :imageID");
        $getUserID->bindValue(':imageID', $this->m_iImageID );
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $avatarLocation = $conn->prepare("
                                 SELECT avatar
                                 FROM users
                                 WHERE userID = :userID");
        $avatarLocation->bindValue(':userID', $userID['imageUserID']);
        $avatarLocation->execute();
        $result= $avatarLocation->fetch(PDO::FETCH_ASSOC);

        return $result;


    }
}