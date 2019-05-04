<?php
session_start();
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LikesManager.php');
require_once('model/GalleryManager.php');
require_once('model/UserManager.php');

function showMedia($arg, $picture_id)
{
    $galleryManager = new GalleryManager();
    $userManager = new UserManager();
    $commentManager = new CommentManager();
    $likesManager = new LikesManager();

    $gallery = $galleryManager->getPictures();
    $users = $userManager->getUsers();
    $comments = $commentManager->getComments();
    $likes = $likesManager->getLikes();

    if ($arg == "picture")
    {
        require('view/pictureView.php');
    }
    else if ($arg = "gallery")
    {
        require('view/galleryView.php');
    }
}