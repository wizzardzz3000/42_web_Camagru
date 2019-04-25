<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <div class="top_bar">
            <ul class="top_bar_elements">
                <li class="logo" onclick="location.href='index.php';" style="cursor:pointer;">Camagru</li>
                <li class="right">Login/Logout</li>
                <li class="right">Account</li>
            </ul>
        </div>
    </head>
    <hr>
    <body>
        <?= $content ?>
        <?= $errorMsg ?>
    </body>
    <hr>
    <footer>
        <p>© Martin Scaglioni 2019</p>
    </footer>
</html>