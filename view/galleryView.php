<?php ob_start(); ?>

<h4>Gallery</h4>
    <div class="product">
        <div class="main-nav">
            <?php
                // Save user PDO object as array using fetchAll()
                $user = $users->fetchAll();
                $comment = $comments->fetchAll();
                $like = $likes->fetchAll();
                
                while ($data = $gallery->fetch())
                {  
                    $comment_nb = 0;
                    $likes_nb = 0;
                    for ($i = 0; $user[$i]; $i++) {
                        if ($user[$i]['user_id'] == $data['user_id'])
                        {
                            $user_name = $user[$i]['user_name'];
                        }
                    }
                    for ($i = 0; $comment[$i]; $i++) {
                        if ($comment[$i]['picture_id'] == $data['picture_id'])
                        {
                            $comment_nb++;
                        }
                    }
                    for ($i = 0; $like[$i]; $i++) {
                        if ($like[$i]['picture_id'] == $data['picture_id'])
                        {
                            $likes_nb++;
                        }
                    }
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <a href=''>
                    <?php
                        $img = $data['content'];
                        echo '<img class="gallery_picture" src="pictures/'.$img.'"/>';
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
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>