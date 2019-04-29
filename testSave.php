<?php

require_once('model/GalleryManager.php');

if(isset($_POST['canvasData'])){
    $data = $_POST['canvasData'];
    saveData($data);
}

function saveData($data)
{
    $galleryManager = new GalleryManager();

    // to disk
    $input = $data;
    $time = time();
    $name = $time . '.png';
    $output = 'pictures/' . $name;
    file_put_contents($output, file_get_contents($input));

    $pic = $galleryManager->savePictures(($name));
}