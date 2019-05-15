<?php ob_start(); ?>

<div class="gallery_top">
    <h4>Gallery</h4>
</div>

<div class="mainView">
    <div class="main_box">
        <section id="gallery_pictures">
    <?php
        // Save PDO objects as arrays using fetchAll()
        $user = $users->fetchAll();
        $comment = $comments->fetchAll();
        $like = $likes->fetchAll();
        $picture = $gallery->fetchAll();

        for ($i = 0; $picture[$i]; $i++)
        {
            $comment_nb = 0;
            $likes_nb = 0;

            for ($j = 0; $user[$j]; $j++)
            {
                if ($user[$j]['user_id'] == $picture[$i]['user_id'])
                {
                    $user_name = $user[$j]['user_name'];
                }
            }
            for ($k = 0; $comment[$k]; $k++)
            {
                if ($comment[$k]['picture_id'] == $picture[$i]['picture_id'])
                {
                    $comment_nb++;
                }
            }
            for ($l = 0; $like[$l]; $l++)
            {
                if ($like[$l]['picture_id'] == $picture[$i]['picture_id'])
                {
                    $likes_nb++;
                }
            }
    ?>

            <div id='full_product'>
                <a href="index.php?view=picture&id=<?= $picture[$i]['picture_id'] ?>">
                <?php
                    $img = $picture[$i]['content'];
                    echo '<img class="gallery_picture" src="pictures/snaps/'.$img.'"/>';
                ?>
                <div class="band">
                    <?
                        echo '<span>by '.$user_name.'</span>';
                        echo '<span>'.$likes_nb.' Likes</span>';
                        echo '<span>'.$comment_nb.' Comments</span>';
                    ?>
                </div>
                </a>
            </div>

    <?php
        }
    ?>
            </section>
    </div>
</div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>