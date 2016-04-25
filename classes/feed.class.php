<?php
class Feed{
    private $m_iUserID;
    private $m_sUsername;
    
    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty){
            case "userID":
                $this->m_iUserID = $p_vValue;
                break;
            case "Username":
                $this->m_sUsername = $p_vValue;
                break;
        }
    }
    
    public function __get($p_sProperty)
    {
        switch($p_sProperty){
            case "userID":
                return $this->m_iUserID;
                break;
            case "Username":
                return $this->m_sUsername;
                break;
        }
    }
    
    public function getFeed(){
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select * from posts order by timestamp desc");
        $statement->execute();
        $rows_found = $statement->rowCount();
        echo $rows_found;
        $result = $statement->fetchAll();
        
}
}



?>