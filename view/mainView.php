<?php
    ob_start();
?>

<div class="filters_list">
    <?php
        for ($i = 0; $filters[$i]; $i++)
        {
            if (strpos($filters[$i], '.png'))
            {
                echo '<div tabindex="-1" class="filter_box" id="\''.$filters[$i].'\'" onclick="selectFilter(\''.$filters[$i].'\')">';
                    echo '<img class="filter" id="\''.$filters[$i].'\'" src="pictures/filters/'.$filters[$i].'"/>';
                echo '</div>';
            }
        }
    ?>
</div>

<div class="mainView" id="main_view">

    <div class="left_box">
        <video class="camera_view" id="video" autoplay></video>
        <div class="filter_view">
            <img class="filter_img" id="filter_image" src="">
        </div>
        <div class="buttons_list">
            <button  type="button" disabled class="snap_button" id="snap_button" onclick="checkButtonMode()">Snap it!</button>
            <button class="import_button" id="import_button" onclick="importPicture()">Import a picture</button>
            <input type="file" id="imgLoader"/>
        </div>
        <canvas class="snap_view" id="snap_canvas"></canvas>
    </div>

    <div class="right_box">
    <div class="right_box_top">
        <h5>Your pictures</h5>
        </div>
        <section id="user_pictures">
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
                            <a href="index.php?view=picture&id=<?= $picture[$i]['picture_id'] ?>">
                                <?php
                                    echo '<img class="gallery_picture_small" src="pictures/snaps/'.$picture[$i]['content'].'"/>';
                                ?>
                            </a>
                    </div>
            <?php
                    }
                }
            ?>
        </section>
    </div>

</div>

<script src="/javascript/take_pic.js"></script>
<script src="/javascript/select_filter.js"></script>
<script src="/javascript/import_picture.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>