<?
require_once('model/Manager.php');

class LikesManager extends Manager
{
    public function getLikes()
    {
        $db = $this->dbConnect();
        $likes = $db->query('SELECT picture_id, user_id FROM likes ORDER BY id ASC');
    
        return $likes;
    }

    public function saveLike($picture_id, $user_id)
    {
        $db = $this->dbConnect();
        $likes = $db->prepare('INSERT INTO pictures(picture_id, user_id) VALUES(?, ?)');
        $affectedLines = $likes->execute(array($picture_id, $user_id));

        return $affectedLines;
    }
}