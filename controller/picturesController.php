<?php
session_start();
require_once('model/CommentManager.php');
require_once('model/LikesManager.php');
require_once('model/PictureManager.php');
require_once('model/UserManager.php');

function showMedia($arg, $picture_id)
{
    $galleryManager = new PictureManager();
    $userManager = new UserManager();
    $commentManager = new CommentManager();
    $likesManager = new LikesManager();

    $gallery = $galleryManager->getPictures("");
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

function deletePicture($picture_id)
{
    $pictureManager = new PictureManager();

    if ($picture = $pictureManager->getPictures($picture_id))
    {
        $pic = $picture->fetchAll();
        $picture_name = $pic[0]['content'];
    }


    if ($delete = $pictureManager->deleteSinglePicture($picture_id, $picture_name));
    {
        header('Location: index.php');
    }
}