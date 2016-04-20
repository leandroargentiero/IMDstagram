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
        $m_sFilePath = "files/" . $_SESSION['user'] . time()."\.jpg"; // userId_timestamp.jpg  //1_12345678.jpg
        $_SESSION['image'] = $m_sFilePath;
        move_uploaded_file($_FILES["file"]["tmp_name"], $m_sFilePath);
        
    }
    
    public function saveImage(){
        $conn = new PDO('mysql:host=localhost; dbname=imdstagram', 'root', 'root');
        $statement = $conn->prepare("insert into posts (filePath, desc) values (:filePath, :desc)");
        $statement->bindValue(":filePath", $this->Image);
        $statement->bindValue(":desc", $this->Description);
        $statement->execute();
    }
}

?>