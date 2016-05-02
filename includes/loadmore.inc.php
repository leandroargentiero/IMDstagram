<?php 
    session_start();    
    $_SESSION['getal'] += 1;
    $_SESSION['offset'] += 1;
    $csa = $_SESSION['csa'];
    $getal = $_SESSION['getal'];
    $offset = $_SESSION['offset'];
    $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("
        select * from posts 
        where imageUserID in (:array) 
        order by timestamp desc 
        limit 1 offset :offset
        ");
        $statement->bindValue(":array", $csa);
        $statement->bindValue(':offset', (int) trim($offset), PDO::PARAM_INT);
        /* $statement->bindValue(':getal', (int) trim($getal), PDO::PARAM_INT); */
        $statement->execute();
       
        $result = $statement->fetch();
        
            
               echo $result['fileLocation'];
                
        
?>