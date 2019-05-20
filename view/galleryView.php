<?php ob_start(); ?>

<div class="mainView">
<div class="gallery_top">
    <h4>Gallery</h4>
</div>
    <div class="main_box">
        <section class="gallery_pictures">
    <?php
        // Save PDO objects as arrays using fetchAll()
        $user = $users->fetchAll();
        $comment = $comments->fetchAll();
        $like = $likes->fetchAll();
        $picture = $gallery->fetchAll();

        // if($_GET['page'] > 0)
        // {
        //     $page = $_GET['page'];
        //     $items_per_page = 9;
        //     $start = ($page - 1) * $items_per_page;
        // }
        // for ($i = $start; $picture[$i]; $i++)
        for ($i = 0; $picture[$i]; $i++)
        {
            // if ($i <= $start + 8)
            // {
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
            // }
        }
    ?>
            </section>

        <!-- <div class="paginator">
            <?php
                for ($count = 0; $picture[$count]; $count++)
                {
                    $nb_of_pages = ceil($count / 9);
                }

                if(($page - 1) > 0)
                {
                    $previous = $page -1;
                    echo '<a href="index.php?view=gallery&page='.$previous.'"> <h5> < </h5> </a>';
                }
                if($nb_of_pages > 0)
                {
            ?>

            <h5>Page <?= $page ?> / <?= $nb_of_pages ?></h5>
            
            <?php
                }
                if (($page + 1) <= $nb_of_pages)
                {
                    $next = $page + 1;
                    echo '<a href="index.php?view=gallery&page='.$next.'"><h5> > </h5> </a>';
                }
            ?>
        </div> -->


</div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>