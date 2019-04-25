<?php ob_start(); ?>

<?php
    if ($comment = $comments->fetch())
    {
?>
        <p><a href="index.php?action=post&amp;id=<?= $comment['post_id']?>">Retour au post</a></p>
<?php
    }
?>
    <h2>Modifiez le commentaire :</h2>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr']?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
  
    <form action="index.php?action=modify&amp;id=<?= $comment['id'] ?>" method="post">
        <div>
            <label for="comment">Nouveau commentaire :</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>