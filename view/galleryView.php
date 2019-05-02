<?php ob_start(); ?>
<h4>Gallery</h4>
    <div class="product">
        <div class="main-nav">
            <?php
                while ($data = $gallery->fetch())
                {
            ?>
            <div id='full_product'>
                <div id='single_product'>
                    <a href=''>
                    <?php
                        $img = $data['content'];
                        echo '<img src="pictures/'.$img.'"/>';
                    ?>
                    </a>
                </div>
            </div>
            <?php
                }
                $gallery->closeCursor();
            ?>
        </div>
    </div>
    
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>