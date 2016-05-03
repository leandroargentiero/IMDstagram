<?php
session_start();
class Feed {
    private $m_iUserID;
    private $m_oResults;
    
    public function __set($p_sProperty, $p_vValue){
        switch($p_sProperty){
            case 'UserID':
                $this->m_sUserID = $p_vValue;
                break;
            case 'Result':
                $this->m_oResults = $p_vValue;
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
        }
    }
    
    public function getFeed($p_sProperty){
        $this->m_iUserID = $p_sProperty;
        // - Eerst zien wie de user volgt
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("select targetUserID from follows where requestUserID = :requestUserID");
        $statement->bindValue(":requestUserID", $_SESSION['userID']);
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
    $csa = implode(", ",$array);
    $_SESSION['csa'] = $csa;

    // selecteren
    $_SESSION['getal'] = 20;
    $_SESSION['offset'] = 20;
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("
        select * from posts 
        where imageUserID in (:array) 
        order by timestamp desc 
        limit :getal
        ");
        $statement->bindValue(":array", $csa);
        $statement->bindValue(':getal', (int) trim($_SESSION['getal']), PDO::PARAM_INT);
        $statement->execute();
        
        $results = $statement->fetchAll();
        
        $this->m_oResults = $results;
    }
    
}

?>