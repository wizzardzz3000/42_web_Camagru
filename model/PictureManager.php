<?
require_once('model/Manager.php');

class PictureManager extends Manager
{
    public function getPictures()
    {
        $db = $this->dbConnect();
        $pictures = $db->query('SELECT picture_id, user_id, content FROM pictures ORDER BY content DESC');
    
        return $pictures;
    }

    public function savePictures($user_id, $content)
    {
        $db = $this->dbConnect();
        $pictures = $db->prepare('INSERT INTO pictures(user_id, content) VALUES(?, ?)');
        $affectedLines = $pictures->execute(array($user_id, $content));

        return $affectedLines;
    }

    public function deleteSinglePicture($picture_id)
    {
        $db = $this->dbConnect();
        
        $picture = $db->prepare("DELETE FROM pictures WHERE picture_id = '$picture_id'");
        $likes = $db->prepare("DELETE FROM likes WHERE picture_id = '$picture_id'");
        $comments = $db->prepare("DELETE FROM comments WHERE picture_id = '$picture_id'");

        $affectedLines = $picture->execute();
        $res1 = $likes->execute();
        $res2 = $comments->execute();

        return $affectedLines;
    }
}