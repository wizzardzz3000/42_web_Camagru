<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/Manager.php';

class PictureManager extends Manager
{
    public function getPictures($picture_id)
    {
        $db = $this->dbConnect();
        if ($picture_id != '')
        {
            $pictures = $db->query("SELECT picture_id, user_id, content FROM pictures WHERE picture_id = '$picture_id'");
        }
        else
        {
            $pictures = $db->query('SELECT picture_id, user_id, content FROM pictures ORDER BY picture_id DESC');
        }
    
        return $pictures;
    }

    public function savePictures($user_id, $content)
    {
        $db = $this->dbConnect();
        $pictures = $db->prepare('INSERT INTO pictures(user_id, content) VALUES(?, ?)');
        $affectedLines = $pictures->execute(array($user_id, $content));

        return $affectedLines;
    }

    public function deleteSinglePicture($picture_id, $picture_name)
    {
        $db = $this->dbConnect();
        
        $picture = $db->prepare("DELETE FROM pictures WHERE picture_id = '$picture_id'");
        $likes = $db->prepare("DELETE FROM likes WHERE picture_id = '$picture_id'");
        $comments = $db->prepare("DELETE FROM comments WHERE picture_id = '$picture_id'");

        $affectedLines = $picture->execute();
        $res1 = $likes->execute();
        $res2 = $comments->execute();

        $file_path = $_SERVER['DOCUMENT_ROOT'].'/pictures/snaps/';

        if (file_exists($file_path . $picture_name))
            unlink($file_path . $picture_name);

        return $affectedLines;
    }
}