<?php
include_once ("includes/database.inc.php");

class Post{
    private $m_sImage;
    private $m_sDescription;
    private $m_sFilePath;
    private $m_sFilter;
    private $m_sLocation;

    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty){
            case "Image":
                $this->m_sfilePath = $p_vValue;
                break;
            case "Description":
                $this->m_sDescription = $p_vValue;
                break;
            case "Filter":
                $this->m_sFilter = $p_vValue;
            case "Location":
                $this->m_sLocation = $p_vValue;
                break;
        }
    }
    
    public function __get($p_sProperty)
    {
        switch($p_sProperty){
            case "Image":
                return $this->m_sfilePath;
                break;
            case "Description":
                return $this->m_sDescription;
                break;
            case "Filter":
                return$this->m_sFilter;
            case "Location":
                return $this->m_sLocation;
                break;
        }
    }
    
    public function moveImage() {
        // Tijdelijke locatie van de upload opvragen
        $filename = $_FILES["file"]["tmp_name"];
        // checken of het wel degelijk een afbeelding is.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);
        // nieuwe locatie en filename aanmaken
        // files/userID_timestamp.jpg
        $m_sFilePath = "files/" . $_SESSION['userID'] . "_" . time().".jpg";
        // functie om de file te moven
        move_uploaded_file($_FILES["file"]["tmp_name"], $m_sFilePath);
        // nieuwe locatie opslaan in variabele voor de query
        $this->m_sFilePath = $m_sFilePath;
    }
    
    public function savePost(){
        global $conn;
        $statement = $conn->prepare("insert into posts (fileLocation, description, imageUserID, filter,location)
                                     values (:fileLocation, :description, :imageUserID, :filter, :location)");
        $statement->bindValue(":fileLocation", $this->m_sFilePath);
        $statement->bindValue(":description", $this->m_sDescription);
        $statement->bindValue(":imageUserID", $_SESSION['userID']);
        $statement->bindValue(":filter", $this->m_sFilter);
        $statement->bindValue(":location", $this->m_sLocation);
        if ($statement->execute()){
            header('Location: index.php');
        }
    }
    
}

?>