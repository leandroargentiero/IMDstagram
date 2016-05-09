<?php
class Feed {
    private $m_iUserID;
    private $m_oResults;
    private $m_iPostCount;
    
    public function __set($p_sProperty, $p_vValue){
        switch($p_sProperty){
            case 'UserID':
                $this->m_sUserID = $p_vValue;
                break;
            case 'Result':
                $this->m_oResults = $p_vValue;
                break;
            case 'PostCount':
                $this->m_iPostCount = $p_vValue;
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
            case 'PostCount':
                return $this->m_iPostCount;
                break;
        }
    }
    
    public function getFeed($p_sProperty){
        $this->m_iUserID = $p_sProperty;
        // - Eerst zien wie de user volgt
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select targetUserID from follows where requestUserID = :requestUserID");
        $statement->bindValue(":requestUserID", $this->m_iUserID);
        $statement->execute();
        $rows_found = $statement->rowCount();
        $results = $statement->fetchAll();

    
    
        // gevonden users in een array stoppen voor de select
        $array = array();

        // eigen foto's niet vergeten.
        array_push($array, $_SESSION['userID']);
        foreach($results as $entry){ 
            array_push($array, $entry['targetUserID']);
        }
        
        // array 'plat' maken voor de select.
        $csa = implode(",",$array);
        $_SESSION['csa'] = $csa;
        // selecteren
        $_SESSION['getal'] = 20;
        $_SESSION['offset'] = 20;
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("
            select * from posts 
            where imageUserID in (select targetUserID from follows where requestUserID = :requestUserID)
            order by timestamp desc 
            limit :getal
            ");
        /* $statement->bindParam(':array', $csa); */
        $statement->bindValue(":requestUserID", $this->m_iUserID);
        $statement->bindValue(':getal', (int) trim($_SESSION['getal']), PDO::PARAM_INT);
        $statement->execute();
        
        $results = $statement->fetchAll();
        $this->m_oResults = $results;
    }
    
    public function getProfileFeed($p_sProperty){
        
        $this->m_iUserID = $p_sProperty;
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select * from posts where imageUserID = :userID order by timestamp desc");
        $statement->bindValue(':userID', $this->m_iUserID);
        $statement->execute();
        $results = $statement->fetchAll();
        $postCount = $statement->rowCount();
        
        $this->m_oResults = $results;
        
        $this->m_iPostCount = $postCount; 
    }
    
}

?>