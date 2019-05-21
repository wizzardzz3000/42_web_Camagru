<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/LikesManager.php';

if(isset($_POST['picture_id']) && isset($_POST['user_id']) && isset($_POST['arg']))
{
    if($_POST['arg'] == '(Like)')
    {
        like($_POST['picture_id'], $_POST['user_id']);
    }
    if($_POST['arg'] == '(Unlike)')
    {
        unlike($_POST['picture_id'], $_POST['user_id']);
    }
}

function like($picture_id, $user_id)
{
    $likesManager = new LikesManager();

    if ($likes = $likesManager->saveLike($picture_id, $user_id))
    {
        // ajaxify
    }
}

function unlike($picture_id, $user_id)
{
    $likesManager = new LikesManager();
    
    if ($likes = $likesManager->deleteLike($picture_id, $user_id))
    {
        // ajaxify
    }
}