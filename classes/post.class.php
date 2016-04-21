<?php 
class Post{
    private $m_sImage;
    private $m_sDescription;
    private $m_sFilePath;
    
    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty){
            case "Image":
                $this->m_sfilePath = $p_vValue;
                break;
            case "Description":
                $this->m_sDescription = $p_vValue;
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
        }
    }
    
    public function moveImage() {
        $filename = $_FILES["file"]["tmp_name"];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($filename);
        $m_sFilePath = "files/" . $_SESSION['user'] . "_" . time().".jpg"; // userId_timestamp.jpg  //1_12345678.jpg
        move_uploaded_file($_FILES["file"]["tmp_name"], $m_sFilePath);
        $this->m_sFilePath = $m_sFilePath;
    }
    
    public function savePost(){
        
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("insert into posts (fileLocation, description) values (:fileLocation, :description)");
        $statement->bindValue(":fileLocation", $this->m_sFilePath);
        $statement->bindValue(":description", $this->m_sDescription);
        $statement->execute();
        
    }
}

?>