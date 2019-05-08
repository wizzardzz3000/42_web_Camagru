<?php
    ob_start();
?>

<div class="filters_list">
    <?php
        for ($i = 0; $filters[$i]; $i++)
        {
            if (strpos($filters[$i], '.png'))
            {
                echo '<img class="filter" src="pictures/filters/'.$filters[$i].'"/>';
            }
        }
    ?>
</div>

<div class="mainView">

    <div class="left_box">
            <video class="camera_view" id="video" autoplay></video>
            <button class="snap_button" id="startbutton">Snap it!</button>
            <canvas class="snap_view" id="canvas"></canvas>

    </div>

    <div class="right_box">
        <div class="main2">
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
                    <div id='full_product_small'>
                        <div id='single_product_small'>
                            <a href="index.php?view=picture&id=<?= $picture[$i]['picture_id'] ?>">
                                <?php
                                    echo '<img class="gallery_picture" src="pictures/snaps/'.$picture[$i]['content'].'"/>';
                                ?>
                            </a>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>

</div>


<script src="javascript/take_pic.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>