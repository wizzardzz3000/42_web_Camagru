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
                                    echo '<img class="gallery_picture_small" src="pictures/snaps/'.$picture[$i]['content'].'"/>';
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