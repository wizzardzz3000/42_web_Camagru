<?php ob_start(); ?>

<h4>Gallery</h4>

<div class="mainView">
    <div class="main_box">
        <section id="content">
    <?php
        // Save PDO objects as arrays using fetchAll()
        $user = $users->fetchAll();
        $comment = $comments->fetchAll();
        $like = $likes->fetchAll();
        
        while ($picture = $gallery->fetch())
        {  
            $comment_nb = 0;
            $likes_nb = 0;
            for ($i = 0; $user[$i]; $i++) {
                if ($user[$i]['user_id'] == $picture['user_id'])
                {
                    $user_name = $user[$i]['user_name'];
                }
            }
            for ($i = 0; $comment[$i]; $i++) {
                if ($comment[$i]['picture_id'] == $picture['picture_id'])
                {
                    $comment_nb++;
                }
            }
            for ($i = 0; $like[$i]; $i++) {
                if ($like[$i]['picture_id'] == $picture['picture_id'])
                {
                    $likes_nb++;
                }
            }
    ?>

            <div id='full_product'>
                <a href="index.php?view=picture&id=<?= $picture['picture_id'] ?>">
                <?php
                    $img = $picture['content'];
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