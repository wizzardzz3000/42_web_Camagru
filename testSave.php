<?php

require_once('model/GalleryManager.php');

if(isset($_POST['canvasData'])){
    $data = $_POST['canvasData'];
    saveData($data);
}

function saveData($data)
{
    $galleryManager = new GalleryManager();
    $pic = $galleryManager->savePictures(($data));
}