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

// CHECK ACTION (CALLED FROM AJAX)
// ---------------------------------------------------------------
if(isset($_POST['img']))
{
    $image = $_POST['img'];
    $filter = "";

    if (isset($_POST['filterName']))
    {
        $filter = $_POST['filterName'];
    }

    saveTmp($image, $filter);
}

if(isset($_POST['action']) && $_POST['action'] == 'save')
{
    savePicture();
}

if(isset($_POST['action'])&& $_POST['action'] == 'delete')
{
    deleteTmp();
}

// SAVE TEMPORARY PICTURE
// ---------------------------------------------------------------
function saveTmp($img, $filter)
{
    $galleryManager = new PictureManager();
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");

    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    // save picture
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $dest = base64_decode($img);
    file_put_contents("../pictures/tmp/tmp.png", $dest);

    // get filter and assemble
    $sourceImage = "../pictures/filters/" . $filter;
    $destImage = '../pictures/tmp/tmp.png';
    $src = imagecreatefrompng($sourceImage);
    $imageResized = imagescale($src, 200, 200);
    $dest = imagecreatefrompng($destImage);
    imagecopy($dest, $imageResized, 130, 0, 0, 0, 200, 200);

    // save final picture
    $time = microtime();
    $time = str_replace(' ', ':', $time);
    $file_name = "id=" . $user_id . "&" . $time . '.png';
    imagepng($dest, '../pictures/tmp/' . $file_name);
    $img = base64_encode(file_get_contents('../pictures/tmp/' . $file_name));

    // free memory
    unlink('../pictures/tmp/tmp.png');
    imagedestroy($src);
    imagedestroy($dest);
}

// SAVE PICTURE IN FOLDER AND DATABASE
// ---------------------------------------------------------------
function savePicture()
{
    $galleryManager = new PictureManager();
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");

    $old_path = '../pictures/tmp/';
    $new_path = '../pictures/snaps/';
    $file = glob($old_path . 'id='.$user_id.'*');
    $filename = strstr($file[0], 'id');

    rename($old_path . $filename, $new_path . $filename);

    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    // // save link to db
    if ($pic = $galleryManager->savePictures($user_id, $filename))
    {
        //ajaxify !
    }
    //error catch ?

}

// DELETE TEMPORARY PICTURE
// ---------------------------------------------------------------
function deleteTmp()
{
    $userManager = new UserManager();

    $users = $userManager->getUser($_SESSION["loggued_on_user"], "");

    if ($user = $users->fetch())
    {
        $user_id = $user['user_id'];
    }

    $path = '../pictures/tmp/'; 
    $file = glob($path . 'id='.$user_id.'*');
    $filename = strstr($file[0], 'id');

    unlink('../pictures/tmp/' . $filename);
}