<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/model/CommentManager.php';

function getComment($comment_id)
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getSingleComment($comment_id);

    require('view/updateCommentView.php');
}

function addComment($picture_id, $user_id, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($picture_id, $user_id, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        checkForEmailNotification("comment", $picture_id);
        header('Location: index.php?view=picture&id=' . $picture_id);
    }
}

function showCommentUpdateView($comment_id, $picture_id)
{
    $commentManager = new CommentManager();
    $userManager = new UserManager();

    $singleComment = $commentManager->getSingleComment($comment_id);
    $users = $userManager->getUsers();

    require('view/updateCommentView.php');
}

function modifyComment($comment_id, $picture_id, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->updateComment($comment_id, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?view=picture&id=' . $picture_id);
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