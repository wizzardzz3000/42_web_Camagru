<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/GalleryManager.php');

function showGallery()
{
    $galleryManager = new GalleryManager();
    $gallery = $galleryManager->getPictures();

    require('view/galleryView.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function comment()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getSingleComment($_GET['id']);

    require('view/updateCommentView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function modifyComment($commentId, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->updateComment($commentId, $comment);
    $postId = $commentManager->getSingleComment($commentId);
    $id = $postId->fetch();

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $id['post_id']);
    }
}