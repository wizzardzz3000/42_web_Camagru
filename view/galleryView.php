<?php ob_start(); ?>
<p>Gallery :</p>
<?php
while ($data = $gallery->fetch())
{
?>
    <div class="pictures">
        <p>
            <?php
            $img = $data['content'];
            echo '<img src="'.$img.'"/>';
            ?>
            <br />
        </p>
    </div>
<?php
}
$gallery->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

