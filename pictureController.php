<?php
session_start();
require_once('model/PictureManager.php');
require_once('model/UserManager.php');

if(isset($_POST['canvasData']))
{
    $data = $_POST['canvasData'];
    saveData($data);
}

function saveData($data)
{
    $galleryManager = new GalleryManager();
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");
    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    $input = $data;
    $time = time();
    $name = $time . '.png';
    $output = 'pictures/' . $name;
    file_put_contents($output, file_get_contents($input));
    $pic = $galleryManager->savePictures($user_id, $name);
}