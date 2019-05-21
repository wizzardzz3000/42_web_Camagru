<?php
    error_reporting(0);
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Fidelio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link rel="icon" type="image/x-icon" sizes="16x16 32x32" href="/public/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <section id="container">

        <section id="header">
            <header>
                <div class="nav-menu" id="menu">
                    <h6 class="logo" onclick="location.href='index.php';" style="cursor:pointer;">Fidelio</h6>
                    <?php
                    if (!$_SESSION['loggued_on_user'])
                    {
                        echo '<a class="right" onclick=location.href="index.php?view=user" style="cursor:pointer;">Login / Register</a>';
                        echo '<a class="right" onclick=location.href="index.php?view=gallery&page=1" style="cursor:pointer;">Gallery</a>';
                    } else {
                        echo '<a class="right" onclick=location.href="index.php?action=logout" style="cursor:pointer;">Logout</a>';
                        echo '<a class="right" onclick=location.href="index.php?view=account" style="cursor:pointer;">Hello '.$_SESSION["loggued_on_user"].'</a>';
                        echo '<a class="right" onclick=location.href="index.php?view=camera" style="cursor:pointer;">Take a picture</a>';
                        echo '<a class="right" onclick=location.href="index.php?view=gallery&page=1" style="cursor:pointer;">Gallery</a>';
                    }
                    ?>
                    <a href="javascript:void(0);" class="icon" onclick="menu()">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </header>
        </section>
        
        <section id="center">
            <?= $content ?>
            <div class="error_message_view">
                <p><?= $errorMsg ?></p>
            </div>
        </section>
      
        <section id="footer">
            <footer>
                <p>© Martini Scaglioni 2019 🌚</p>
            </footer>
        </section>
    </section>
    <script src="javascript/index.js"></script>
</html>