<?php
require_once('model/CommentManager.php');

function getComment($post_id)
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getSingleComment($post_id);

    require('view/updateCommentView.php');
}

function addComment($post_id, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($post_id, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $post_id);
    }
}

function modifyComment($comment_id, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->updateComment($comment_id, $comment);
    $post_id = $commentManager->getSingleComment($comment_id);
    $id = $post_id->fetch();

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $id['post_id']);
    }
}