<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/model/PictureManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/FiltersManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/UserManager.php';

// LOAD THE CAMERA VIEW
// ---------------------------------------------------------------
function showMainView()
{
    $galleryManager = new PictureManager();
    $filterManager = new FiltersManager();
    $userManager = new UserManager();

    $gallery = $galleryManager->getPictures("");
    $filters = $filterManager->getFilters();
    $users = $userManager->getUsers();

    require('view/mainView.php');
}

// SAVE THE PICTURE (CALLED FROM AJAX)
// ---------------------------------------------------------------
if(isset($_POST['img']))
{
    $image = $_POST['img'];
    saveData($image);
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

    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);
    $time = microtime();
    $time = str_replace(' ', ':', $time);
    $file_name = $time . '.png';
    $output = '../pictures/snaps/' . $file_name;
    file_put_contents($output, $data);

    if ($pic = $galleryManager->savePictures($user_id, $file_name))
    {
        header('Location: index.php?view=camera');
        //ajaxify !
    }
    // error catch ?
}

// $dest = imagecreatefrompng('vinyl.png');
// $src = imagecreatefromjpeg('cover2.jpg');

// imagealphablending($dest, false);
// imagesavealpha($dest, true);

// imagecopymerge($dest, $src, 10, 9, 0, 0, 181, 180, 100); //have to play with these numbers for it to work for you, etc.

// header('Content-Type: image/png');
// imagepng($dest);

// imagedestroy($dest);
// imagedestroy($src);