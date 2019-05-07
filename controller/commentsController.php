<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/model/CommentManager.php';

function getComment($comment_id)
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getSingleComment($comment_id);

    require('view/updateCommentView.php');
}

function addComment($post_id, $user_id, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($post_id, $user_id, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?view=picture&id=' . $post_id);
    }
}

function modifyComment($comment_id, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->updateComment($comment_id, $comment);
    $comment = $commentManager->getSingleComment($comment_id);
    $picture = $comment->fetch();

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?view=picture&id=' . $picture['picture_id']);
    }
}

function deleteCommentCall($comment_id, $picture_id)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment($comment_id);

    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else {
        header('Location: index.php?view=picture&id=' . $picture_id);
    }
}