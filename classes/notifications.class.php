<?php
include_once ("includes/database.inc.php");
class Notification {
    private $m_iUserID;
    private $m_oResults;
    private $m_iNotifCount;
    
    public function __set($p_sProperty, $p_vValue){
        switch($p_sProperty){
            case 'UserID':
                $this->m_sUserID = $p_vValue;
                break;
            case 'Result':
                $this->m_oResults = $p_vValue;
                break;
            case 'NotifCount':
                $this->m_iNotifCount = $p_vValue;
                break;
        }
    }
    
    
    public function __get($p_sProperty){
        switch($p_sProperty){
            case 'UserID':
                return $this->m_sUserID;
                break;
            case 'Results':
                return $this->m_oResults;
                break;
            case 'NotifCount':
                return $this->m_iNotifCount;
                break;
        }
    }
    
    public function getFollowRequests($p_sProperty){
        global $conn;
        $this->m_iUserID = $p_sProperty;
        $getRequests = $conn->prepare("select * from followrequests where targetUserID = :userID");
        $getRequests->bindValue("userID", $this->m_iUserID);
        $getRequests->execute();
        $requestCount = $getRequests->rowCount();
        $results = $getRequests->fetchAll();
        
        // aantal notificaties opslaan
        $this->NotifCount = $requestCount;
        
        // requests meegeven
        $this->m_oResults = $results;
    }
    
}

?>