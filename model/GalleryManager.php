<?
require_once('model/Manager.php');

class GalleryManager extends Manager
{
    public function getPictures()
    {
        $db = $this->dbConnect();
        $pictures = $db->query('SELECT picture_id, user_id, content FROM pictures');
    
        return $pictures;
    }

    public function savePictures($content)
    {
        $db = $this->dbConnect();
        $pictures = $db->prepare('INSERT INTO pictures(user_id, content) VALUES(?, ?)');
        $affectedLines = $pictures->execute(array(1, $content));

        return $affectedLines;
    }
}