<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/Manager.php';

class CommentManager extends Manager
{
    public function getComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, picture_id, user_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y at %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY id ASC');
        $comments->execute();

        return $comments;
        $comments->closeCursor();
    }

    public function getSingleComment($comment_id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT picture_id, user_id, id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y at %H:%i:%s\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $comment->execute(array($comment_id));

        return $comment;
        $comment->closeCursor();
    }

    public function postComment($picture_id, $user_id, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(picture_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($picture_id, $user_id, $comment));

        return $affectedLines;
        $affectedLines->closeCursor();
    }

    public function updateComment($comment_id, $comment)
    {
        $db = $this->dbConnect();
        $commentos = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $affectedLines = $commentos->execute(array($comment, $comment_id));

        return $affectedLines;
        $affectedLines->closeCursor();
    }

    public function deleteComment($comment_id)
    {
        $db = $this->dbConnect();
        $commentos = $db->prepare("DELETE FROM comments WHERE id = '$comment_id'");
        $affectedLines = $commentos->execute();

        return $affectedLines;
        $affectedLines->closeCursor();
    }
}