<?php ob_start(); ?>

    <?php
        $comment = $singleComment->fetchAll();

        $user = $users->fetchAll();

        for ($i = 0; $user[$i]; $i++)
        {
            if ($user[$i]['user_id'] == $comment[0]['user_id'])
            {
                $author = $user[$i]['user_name'];
            }
        }
    ?>

    <div class="update_comment_view">

        <p><a href="index.php?view=picture&id=<?= $picture_id ?>">Back to picture</a></p><br/>

        <h2>Modifiez le commentaire :</h2>
        <p><strong><?= htmlspecialchars($author) ?></strong> le <?= $comment[0]['comment_date_fr']?></p>
        <p><?= nl2br(htmlspecialchars($comment[0]['comment'])) ?></p>
    
        <form action="index.php?action=modifyComment&comment_id=<?= $comment[0]['id'] ?>&picture_id=<?= $picture_id ?>" method="post">
            <div>
                <label for="comment">Nouveau commentaire :</label><br />
                <textarea class="comment_area" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>

    </div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>