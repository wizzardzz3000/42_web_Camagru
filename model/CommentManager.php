<?
require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, picture_id, user_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY id ASC');

        return $comments;
    }

    public function getSingleComment($comment_id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT picture_id, user_id, id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $comment->execute(array($comment_id));

        return $comment;
    }

    public function postComment($picture_id, $user_id, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(picture_id, user_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($picture_id, $user_id, $author, $comment));

        return $affectedLines;
    }

    public function updateComment($comment_id, $comment)
    {
        $db = $this->dbConnect();
        $commentos = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $affectedLines = $commentos->execute(array($comment, $comment_id));

        return $affectedLines;
    }
}