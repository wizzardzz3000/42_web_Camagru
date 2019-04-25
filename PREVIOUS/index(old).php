<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="top_bar">
            <ul class="actions_list">
                <li class="left">Camagru</li>
                <li class="right">Login / Logout</li>
                <li class="right">Account</li>
            </ul>
        </div>
        <?php
            require('Classes/Database.class.php');
            $db = new Database;

            foreach ($db->query('SELECT * FROM user') as $users) {
                var_dump($users->user_pseudo);
            }

        ?>
        <!-- <div class="filters">
            <ul class="filters_list">
                <li>Filter 1</li>
                <li>Filter 2</li>
                <li>Filter 3</li>
            </ul>
        </div>
        <div class="main">
            <video id="video" autoplay></video>
            <br>
            <button id="startbutton">Prendre une photo</button>
            <br>
            <canvas id="canvas"></canvas>
        </div> -->
        <div class="footer">
            <h1>© 2019 mascagli</h1>
        </div>
        <!-- <script src="take_pic.js"></script> -->
    </body>
</html>