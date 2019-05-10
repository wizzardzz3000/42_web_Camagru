<?
require_once('model/LikesManager.php');

function like($picture_id, $user_id)
{
    $likesManager = new LikesManager();

    if ($likes = $likesManager->saveLike($picture_id, $user_id))
    {
        checkForEmailNotification("like", $picture_id);
        header('Location: index.php?view=picture&id='.$picture_id.'');
    }
}

function unlike($picture_id, $user_id)
{
    $likesManager = new LikesManager();
    
    if ($likes = $likesManager->deleteLike($picture_id, $user_id))
    {
        header('Location: index.php?view=picture&id='.$picture_id.'');
    }
}