<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <div class="top_bar">
            <ul class="top_bar_elements">
                <li class="logo" onclick="location.href='index.php';" style="cursor:pointer;">Camagru</li>
                <?php
                if(($_SESSION['loggued_on_user'] === ''))
                {
                    echo '<li class="right" onclick=location.href="index.php?view=user" style="cursor:pointer;">Login/Register</li>';
                    echo '<li class="right" onclick=location.href="index.php?view=gallery" style="cursor:pointer;">Gallery</li>';
                } else {
                    echo '<li class="right" onclick=location.href="index.php?action=logout" style="cursor:pointer;">Logout</li>';
                    echo '<li class="right" onclick=location.href="index.php?view=account" style="cursor:pointer;">Hello '.$_SESSION["loggued_on_user"].'</li>';
                    echo '<li class="right" onclick=location.href="index.php?view=camera" style="cursor:pointer;">Take a picture</li>';
                    echo '<li class="right" onclick=location.href="index.php?view=gallery" style="cursor:pointer;">Gallery</li>';
                }
                ?>
            </ul>
        </div>
    </head>
    <hr>
    <body>
        <div class ="main_div">
            <?= $content ?>
            <?= $errorMsg ?>
        </div>
    </body>
    <hr>
    <footer>
        <p>© Martin Scaglioni 2019</p>
    </footer>
</html>