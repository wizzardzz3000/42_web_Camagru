<?php ob_start(); ?>

    <div class="product">
        <div class="main-nav">
            <?php
                // Save PDO objects as arrays using fetchAll()
                $user = $users->fetchAll();
                $comment = $comments->fetchAll();
                $like = $likes->fetchAll();
                $pictures = $gallery->fetchAll();

                $likes_nb = 0;

                for ($i = 0; $pictures[$i]; $i++)
                {
                    if ($pictures[$i]['picture_id'] == $picture_id)
                    {
                        $img = $pictures[$i]['content'];
                    }
                }
                
                // for ($i = 0; $user[$i]; $i++) {
                //     if ($user[$i]['user_id'] == $data['user_id'])
                //     {
                //         $user_name = $user[$i]['user_name'];
                //     }
                // }
                for ($i = 0; $like[$i]; $i++) {
                    if ($like[$i]['picture_id'] == $picture_id)
                    {
                        $likes_nb++;
                    }
                }
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <?php
                        echo '<img class="gallery_picture" src="pictures/'.$img.'"/>';
                    ?>
                </div>
            </div>

            <?php
                for ($i = 0; $comment[$i]; $i++)
                {
                    if ($comment[$i]['picture_id'] == $picture_id)
                    {
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <p><strong><?= htmlspecialchars($comment[$i]['author']) ?></strong> le <?= $comment[$i]['comment_date_fr'] ?>
                    <!-- <a href="index.php?action=comment&amp;id=<?= $comment[$i]['id'] ?>">(Modifier)</a></p> -->
                    <p><?= nl2br(htmlspecialchars($comment[$i]['comment'])) ?></p>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            </div>
                <?php
                    echo '<p> '.$likes_nb.' likes</p>';
                ?>
            <div>
        </div>
    </div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>