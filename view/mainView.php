<?php
    ob_start();
?>

<div class="main">
    <div class="filters_list">
        <p>filter 1</p>
        <p>filter 2</p>
        <p>filter 3</p>
    </div>
    <video id="video" autoplay></video>
    <br>
    <button id="startbutton">Prendre une photo</button>
    <br>
    <canvas id="canvas"></canvas>
</div>

<div class="main">
    <p>Your pictures</p>
    <?php
        $picture = $gallery->fetchAll();
        $user = $users->fetchAll();

        for ($i = 0; $user[$i]; $i++)
        {
            if ($user[$i]['user_name'] == $_SESSION['loggued_on_user'])
            {
                $user_id = $user[$i]['user_id'];
            }
        }
        for ($i = 0; $picture[$i]; $i++)
        {
            if ($picture[$i]['user_id'] == $user_id)
            {
    ?>
            <div id='full_product'>
                <div id='single_product'>
                    <a href="index.php?view=picture&id=<?= $picture[$i]['picture_id'] ?>">
                        <?php
                            echo '<img class="gallery_picture" src="pictures/'.$picture[$i]['content'].'"/>';
                        ?>
                    </a>
                </div>
            </div>
    <?php
            }
        }
    ?>
</div>

<script src="javascript/take_pic.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>