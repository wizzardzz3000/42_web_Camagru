<?php ob_start(); ?>

<h4>Gallery</h4>
    <div class="product">
        <div class="main-nav">
            <?php
                $user = $users->fetchAll();
                while ($data = $gallery->fetch())
                {  
                    for ($i = 0; $user[$i]; $i++) {
                        if ($user[$i]['user_id'] == $data['user_id'])
                        {
                            $user_name = $user[$i]['user_name'];
                        }
                    }
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <a href=''>
                    <?php
                        $img = $data['content'];
                        echo '<img src="pictures/'.$img.'"/>';
                    ?>
                    <div class="band">
                        <?
                            echo '<span>by '.$user_name.'</span>';
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