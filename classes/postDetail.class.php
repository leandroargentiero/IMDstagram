<?php
include_once ("includes/database.inc.php");

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
        global $conn;
        $result = array();

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
        global $conn;
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
        $result = $avatarLocation->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUsername(){
        global $conn;
        $getUserID = $conn->prepare("
                                    SELECT imageUserID
                                    FROM posts
                                    WHERE imageID = :imageID");
        $getUserID->bindValue(':imageID', $this->m_iImageID );
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $username = $conn->prepare("SELECT username
                                    FROM users
                                    WHERE userID = :userID");
        $username->bindValue(':userID', $userID['imageUserID']);
        $username->execute();
        $result = $username->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getPostHour(){
        global $conn;
        $postTime = $conn->prepare("SELECT timestamp
                                   FROM posts
                                   WHERE imageID = :imageID");
        $postTime->bindValue(':imageID', $this->m_iImageID);
        $postTime->execute();
        $postTime = $postTime->fetch(PDO::FETCH_ASSOC);

        $currentTime = strtotime(date('Y-m-d H:i:s'));
        $postedTime = strtotime($postTime['timestamp']);

        $difference = $currentTime - $postedTime;
        $days = $difference/60/60/24;
        $hour = $difference/(60*60);
        $minutes = (abs($difference)/60);

        if(number_format($minutes, 0) < 1)
        {
            $result = "A moment ago";
        }
        elseif(number_format($hour, 0) < 1)
        {
            $result = number_format($minutes, 0). " minutes ago" ;
        }
        elseif(number_format($hour, 0) < 24)
        {
            $result = number_format($hour, 0)."h";
        }
        else
        {
            $result = number_format($days, 0)." days ago";
        }
        return $result;
    }

    public function getLikes(){
        global $conn;
        

    }
}