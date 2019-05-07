<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/model/PictureManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/UserManager.php';

if(isset($_POST['img']))
{
    $data = $_POST['img'];
    saveData($data);
}

function saveData($image)
{
    $galleryManager = new PictureManager();
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");
    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    $img = $image;
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $time = time();
    $name = $time . '.png';
    $output = '../pictures/' . $name;
    file_put_contents($output, $data);

    $pic = $galleryManager->savePictures($user_id, $name);
}