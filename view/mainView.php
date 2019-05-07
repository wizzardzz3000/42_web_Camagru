<?php
    ob_start();
?>

<div class="main">
    <video id="video" autoplay></video>
    <br>
    <button id="startbutton">Prendre une photo</button>
    <br>
    <canvas id="canvas"></canvas>
</div>

<script src="javascript/take_pic.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>