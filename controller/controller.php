<?php
session_start();
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LikesManager.php');
require_once('model/GalleryManager.php');
require_once('model/UserManager.php');

function showGallery()
{
    $galleryManager = new GalleryManager();
    $userManager = new UserManager();
    $commentManager = new CommentManager();
    $likesManager = new LikesManager();
    $gallery = $galleryManager->getPictures();
    $users = $userManager->getUsers();
    $comments = $commentManager->getComments();
    $likes = $likesManager->getLikes();

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