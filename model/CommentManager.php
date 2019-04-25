<?
require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getSingleComment($commentId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT post_id, id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $comment->execute(array($commentId));

        return $comment;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function updateComment($commentId, $comment)
    {
        $db = $this->dbConnect();
        $commentos = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $affectedLines = $commentos->execute(array($comment, $commentId));

        return $affectedLines;
    }
}