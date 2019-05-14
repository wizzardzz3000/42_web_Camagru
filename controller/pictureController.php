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
    $filter = "";

    if (isset($_POST['filterName']))
    {
        $filter = $_POST['filterName'];
    }

    saveData($image, $filter);
}

function saveData($img, $filter)
{
    $galleryManager = new PictureManager();
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");
    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    // save picture
    // $image = str_replace('data:image/png;base64,', '', $image);
    // $image = str_replace(' ', '+', $image);
    // $data = base64_decode($image);
    // $time = microtime();
    // $time = str_replace(' ', ':', $time);
    // $file_name = $time . '.png';
    // $output = '../pictures/snaps/' . $file_name;
    // file_put_contents($output, $data);

    // get filter and assemble
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $dest = base64_decode($img);
    file_put_contents("../pictures/tmp.png", $dest);

    $sourceImage = "../pictures/filters/" . $filter;
    $destImage = '../pictures/tmp.png';
    // list($srcWidth, $srcHeight) = getimagesize($imageResized);
    $src = imagecreatefrompng($sourceImage);
    $imageResized = imagescale($src, 200, 200);
    $dest = imagecreatefrompng($destImage);
    imagecopy($dest, $imageResized, 130, 0, 0, 0, 200, 200);

    imagepng($dest,'../pictures/tmp.png');
    $img = base64_encode(file_get_contents('../pictures/tmp.png'));

    // if ($pic = $galleryManager->savePictures($user_id, $file_name))
    // {
    //     header('Location: index.php?view=camera');
    //     //ajaxify !
    // }
    // error catch ?
}